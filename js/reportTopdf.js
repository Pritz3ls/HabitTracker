function convertHTMLtoPDF() {
    const { jsPDF } = window.jspdf;

    let doc = new jsPDF('l', 'mm', [1500, 1400]);
    let pdfjs = document.querySelector('#divID');

    doc.html(pdfjs, {
        callback: function(doc) {
            doc.save("newpdf.pdf");
        },
        x: 12,
        y: 12
    });			 
}		 


{/* <script src=
"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
	</script>
	<script src=
"https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js">
	</script>
	<script src=
"https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js">
	</script> */}