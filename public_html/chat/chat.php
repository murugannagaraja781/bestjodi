<?php
if (session_status() === PHP_SESSION_NONE) {
    @session_start();
}
require_once(__DIR__ . '/../dbConf.php');

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == "chatheartbeat") { chatHeartbeat(); } 
if ($action == "sendchat") { sendChat(); } 
if ($action == "closechat") { closeChat(); } 
if ($action == "startchatsession") { startChatSession(); } 
if ($action == "chatname") { chatName(); } 

if (!isset($_SESSION['chatHistory'])) {
	$_SESSION['chatHistory'] = array();	
}

if (!isset($_SESSION['openChatBoxes'])) {
	$_SESSION['openChatBoxes'] = array();	
}

function chatHeartbeat() {
	global $db;
	if (!$db) {
		echo '{"items":[]}';
		exit(0);
	}
	$chatuser = isset($_SESSION['chatuser']) ? mysqli_real_escape_string($db, $_SESSION['chatuser']) : '';
	$sql = "select register.username,register.gender,register.photo1,chat.from,chat.message,chat.to,chat.id,chat.sent,chat.recd from chat,register where (chat.to = '".$chatuser."' AND recd = 0) and chat.from=register.index_id order by id ASC";
	
	$query = mysqli_query($db, $sql);
	$items = '';

	$chatBoxes = array();

	while ($query && $chat = mysqli_fetch_array($query)) {

		if (!isset($_SESSION['openChatBoxes'][$chat['from']]) && isset($_SESSION['chatHistory'][$chat['from']])) {
			$items = $_SESSION['chatHistory'][$chat['from']];
		}
		$chat['username'] = sanitize($chat['username']);
		$chat['message'] = sanitize($chat['message']);
		if(empty($chat['photo1']))
		{
			 if(isset($chat['gender']) && $chat['gender']=='Male')
			 {
			 $chat['photo1']="../img/male.png";
			 } 		
			 else
			 {
			 $chat['photo1']= "../img/female.png";
			 }			
		}
		$items .= <<<EOD
					   {
			"s": "0",
			"u": "{$chat['username']}",
			"ph": "{$chat['photo1']}",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}"
	   },
EOD;

	if (!isset($_SESSION['chatHistory'][$chat['from']])) {
		$_SESSION['chatHistory'][$chat['from']] = '';
	}

	$_SESSION['chatHistory'][$chat['from']] .= <<<EOD
						   {
			"s": "0",
			"u": "{$chat['username']}",
			"f": "{$chat['from']}",
			"ph": "{$chat['photo1']}",
			"m": "{$chat['message']}"
	   },
EOD;
		
		unset($_SESSION['tsChatBoxes'][$chat['from']]);
		$_SESSION['openChatBoxes'][$chat['from']] = $chat['sent'];
	}

	if (!empty($_SESSION['openChatBoxes'])) {
	foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {
		if (!isset($_SESSION['tsChatBoxes'][$chatbox])) {
			$now = time()-strtotime($time);
			$time = date('g:iA M dS', strtotime($time));

			$message = "Sent at $time";
			if ($now > 180) {
				$items .= <<<EOD
{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;

	if (!isset($_SESSION['chatHistory'][$chatbox])) {
		$_SESSION['chatHistory'][$chatbox] = '';
	}

	$_SESSION['chatHistory'][$chatbox] .= <<<EOD
		{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;
			$_SESSION['tsChatBoxes'][$chatbox] = 1;
		}
		}
	}
}

	$sql = "update chat set recd = 1 where chat.to = '".$chatuser."' and recd = 0";
	$query = mysqli_query($db, $sql);

	if ($items != '') {
		$items = substr($items, 0, -1);
	}
header('Content-type: application/json');
?>
{
		"items": [
			<?php echo $items;?>
        ]
}

<?php
			exit(0);
}

function chatBoxSession($chatbox) {
	
	$items = '';
	
	if (isset($_SESSION['chatHistory'][$chatbox])) {
		$items = $_SESSION['chatHistory'][$chatbox];
	}

	return $items;
}

function startChatSession() {
	$items = '';
	if (!empty($_SESSION['openChatBoxes'])) {
		foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {
			$items .= chatBoxSession($chatbox);
		}
	}


	if ($items != '') {
		$items = substr($items, 0, -1);
	}

header('Content-type: application/json');
$chatuser = isset($_SESSION['chatuser']) ? $_SESSION['chatuser'] : '';
?>
{
		"username": "<?php echo $chatuser;?>",
		"items": [
			<?php echo $items;?>
        ]
}

<?php
	exit(0);
}

function chatName() {
	global $db;
	$un = '';
	
	$su = isset($_GET['usw']) ? mysqli_real_escape_string($db, $_GET['usw']) : '';
	if ($db && $su !== '') {
		$sc2 = mysqli_query($db, "select username from register where uid='$su' limit 1");
		while ($sc2 && $row_sc2 = mysqli_fetch_array($sc2)) {
			$un = $row_sc2["username"];
		}
	}
?>
{
		"unm": ["<?php echo $un;?>"]
}

<?php
	exit(0);
}

function sendChat() {
	global $db;
	if (!$db) {
		echo "0";
		exit(0);
	}
	$from = isset($_SESSION['chatuser']) ? $_SESSION['chatuser'] : '';
	$to = isset($_POST['to']) ? $_POST['to'] : '';
	$message = isset($_POST['message']) ? $_POST['message'] : '';
	
	$from_escaped = mysqli_real_escape_string($db, $from);
	$sql = "select register.username from register where register.index_id='$from_escaped' limit 1";
	$uname = mysqli_query($db, $sql);
	$from_user = '';
	while ($uname && $un = mysqli_fetch_array($uname)) {
		$from_user = $un['username'];
	}
	
	$_SESSION['openChatBoxes'][$to] = date('Y-m-d H:i:s', time());
	
	$messagesan = sanitize($message);

	if (!isset($_SESSION['chatHistory'][$to])) {
		$_SESSION['chatHistory'][$to] = '';
	}

	$_SESSION['chatHistory'][$to] .= <<<EOD
					   {
			"s": "1",
			"u": "{$from_user}",
			"f": "{$to}",
			"m": "{$messagesan}"
	   },
EOD;

	unset($_SESSION['tsChatBoxes'][$to]);

	$to_escaped = mysqli_real_escape_string($db, $to);
	$msg_escaped = mysqli_real_escape_string($db, $message);
	$sql = "insert into chat (`from`,`to`,`message`,`sent`) values ('$from_escaped', '$to_escaped', '$msg_escaped', NOW())";
	$query = mysqli_query($db, $sql);
	echo "1";
	exit(0);
}

function closeChat() {
	if (isset($_POST['chatbox'])) {
		unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);
	}
	echo "1";
	exit(0);
}

function sanitize($text) {
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = str_replace("\n\r","\n",$text);
	$text = str_replace("\r\n","\n",$text);
	$text = str_replace("\n","<br>",$text);
	return $text;
}
?>
