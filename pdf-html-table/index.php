<?php

	function fetch_data()
	{
		$output = '';
		$conn = mysqli_connect('localhost', 'root', 'drfsew@', 'pdfcreator');
		$sql = "SELECT * FROM pdfcreator.pdf_data ORDER BY pdf_data.pdf_id ASC";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result))
		{
			$output .= '<tr>
			<td>'.$row["pdf_id"].'</td>
			<td>'.$row["pdf_name"].'</td>
			<td>'.$row["pdf_email"].'</td>
			<td>'.$row["pdf_date"].'</td>
			</tr>';
		}
		return $output;
	}

	function fetch_data_between($pdf_start, $pdf_end)
	{
		$output = '';
		$conn = mysqli_connect('localhost', 'root', 'drfsew@', 'pdfcreator');
		$sql = "SELECT * FROM pdfcreator.pdf_data WHERE pdf_data.pdf_date BETWEEN '".$pdf_start."' AND '".$pdf_end."' ORDER BY pdf_data.pdf_id ASC";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result))
		{
			$output .= '<tr>
			<td>'.$row["pdf_id"].'</td>
			<td>'.$row["pdf_name"].'</td>
			<td>'.$row["pdf_email"].'</td>
			<td>'.$row["pdf_date"].'</td>
			</tr>';
		}
		return $output;
	}

	if(isset($_POST["generate_pdf"]))
	{
		require_once('tcpdf/tcpdf.php');
		$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$obj_pdf->SetTitle("Generate HTML Table Data To PDF From MySQL Database Using TCPDF");
		$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$obj_pdf->SetDefaultMonospacedFont('helvetica');
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
		$obj_pdf->setPrintHeader(false);
		$obj_pdf->setPrintFooter(false);
		$obj_pdf->SetAutoPageBreak(TRUE, 10);
		$obj_pdf->SetFont('helvetica', '', 11);
		$obj_pdf->AddPage();
		$content = '';

		$content .= '<h4 align="center">
		Generate HTML Table Data To PDF From MySQL Database Using TCPDF
		</h4><br/> 
		<table border="1" cellspacing="0" cellpadding="3">
		<tr>
		<th width="5%">PDF Id</th>
		<th width="30%">PDF Name</th>
		<th width="45%">PDF Email</th>
		<th width="20%">PDF Date</th>
		</tr>';
		if((isset($_POST["pdf-start"])) && (isset($_POST["pdf-end"])))
		{
			echo '<script type="text/javascript">console.log("1");</script>';
			if(($_POST["pdf-start"]!=$_POST["pdf-end"]))
			{
				echo '<script type="text/javascript">console.log("2");</script>';
				$content .= fetch_data_between($_POST["pdf-start"], $_POST["pdf-end"]);
			}
		}
		else
		{
			echo '<script type="text/javascript">console.log("3");</script>';
			$content .= fetch_data();
		}
		$content .= '</table>';
		$obj_pdf->writeHTML($content);
		ob_end_clean();
		$obj_pdf->Output('pdfphp-file.pdf', 'I');
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>SoftAOX | Generate HTML Table Data To PDF From MySQL Database Using TCPDF</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	</head>
	<body>
		<br/>
		<div class="container">
			<h4 align="center">Generate HTML Table Data To PDF From MySQL Database Using TCPDF</h4><br/>
			<div class="table-responsive">
				<div class="col-md-12" align="right">
					<form method="post">
						<label for="start">Start date:</label>
						<input type="date" id="pdf-start" name="pdf-start" value="<?php echo date('Y-m-d'); ?>" min="2010-01-01">
						<label for="start">End date:</label>
						<input type="date" id="pdf-end" name="pdf-end" value="<?php echo date('Y-m-d'); ?>" min="2010-01-01">
						<input type="submit" name="generate_pdf" class="btn btn-success" value="Generate PDF" />
					</form>
				</div>
				<br/>
				<br/>
				<table class="table table-bordered">
					<tr>
						<th width="5%">PDF Id</th>
						<th width="30%">PDF Name</th>
						<th width="45%">PDF Email</th>
						<th width="20%">PDF Date</th>
					</tr>
					<?php echo fetch_data(); ?>
				</table>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		console.log(document.getElementById('pdf-start').value);
		console.log(document.getElementById('pdf-end').value);
	</script>
</html>