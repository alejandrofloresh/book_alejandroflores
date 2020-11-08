function exportTableToExcelData(tableId, filename) {
  var	hoy = new Date();
  var	hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
  let dataType = 'application/vnd.ms-excel';
  let extension = '.xls';

  let base64 = function(s) {
      return window.btoa(unescape(encodeURIComponent(s)))
  };

  let template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>';
  let render = function(template, content) {
      return template.replace(/{(\w+)}/g, function(m, p) { return content[p]; });
  };

  let tableElement = document.getElementById('tabla_numeros');

  let tableExcel = render(template, {
      worksheet: filename,
      table: tableElement.innerHTML
  });

  filename = filename;

  if (navigator.msSaveOrOpenBlob)
  {
      let blob = new Blob(
          [ '\ufeff', tableExcel ],
          { type: dataType }
      );

      navigator.msSaveOrOpenBlob(blob, filename);
  } else {
      let downloadLink = document.createElement("a");

      document.body.appendChild(downloadLink);

      downloadLink.href = 'data:' + dataType + ';base64,' + base64(tableExcel);

      downloadLink.download = filename+hoy+hora+extension;

      downloadLink.click();
  }
}
