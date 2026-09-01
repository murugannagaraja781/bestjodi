<?php
//error_reporting(0);
//session_start();
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn(); 
include_once '../class/Config.class.php';
$configObj = new Config();
$from=$configObj->getConfigContact();
$web_name=$configObj->getConfigFname();;
if (isset($_REQUEST['id'])) 
{
$_SESSION['id']=$_REQUEST['id'];
$_SESSION['username']=$_REQUEST['username'];
$_REQUEST['email'];
// Used for later to determine result
//$SQL_STATEMENT = "select * from register_view,payment_view where register_view.index_id=payment_view.index_id and register_view.index_id=".$index_id;
//$DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
//$DatabaseCo->dbRow = mysqli_fetch_object($DatabaseCo->dbResult);
$success = $error = false;
// Object syntax looks better and is easier to use than arrays to me
//$post = new stdClass;
// Usually there would be much more validation and filtering, but this
// will work for now.
//foreach ($_POST as $key => $val)
//	$post->$key = trim(strip_tags($_POST[$key]));
// Check for blank fields
// Get this directory, to include other files from
// Get this directory, to include other files from
//	$dir = dirname(__FILE__);
// Get the contents of the pdf into a variable for later
ob_start();
require_once('pdf.php');
$pdf_html = ob_get_contents();
ob_end_clean();
echo $pdf_html ; 
// Load the dompdf files
require_once('dompdf/dompdf_config.inc.php');
$dompdf = new DOMPDF(); // Create new instance of dompdf
$dompdf->load_html($pdf_html); // Load the html
//echo $pdf_html;
$dompdf->render(); // Parse the html, convert to PDF
$pdf_content = $dompdf->output(); // Put contents of pdf into variable for later
//echo $pdf_content;
// Get the contents of the HTML email into a variable for later
ob_start();
require_once('html.php');
$html_message = ob_get_contents();
ob_end_clean();
//	echo $html_message;
// Load the SwiftMaciler files
require_once('swift/swift_required.php');
$mailer = new Swift_Mailer(new Swift_MailTransport()); // Create new instance of SwiftMailer
$message = Swift_Message::newInstance()
->setSubject('Save your invoice copy') // Message subject
->setTo(array($_REQUEST['email'])) // Array of people to send to                    $_REQUEST['email']
->setFrom(array($from => $web_name)) // From:
->setBody($html_message, 'text/html') // Attach that HTML message from earlier
->attach(Swift_Attachment::newInstance($pdf_content, 'Invoice.pdf', 'application/pdf')); 
if ($mailer->send($message))
$success = true;
else
$error = true;
}
?>
<?php  $id = isset($_GET['id'])?$_GET['id']:0;;?>
<script>alert('Your Invoice successfully sent ...');
</script>
<script>window.location='Invoice?id=<?php echo $id;?>';
</script>