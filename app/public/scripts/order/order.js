

//added asynchronous order data retrieval since the script is updating html content
async function getAllOrders() {

  const response = await fetch(`${urlBasePath}api/Order/getAllOrders`, {
    method: "GET",
    headers: {
      "Content-Type": "application/json"
    }
  });

  const data = await response.json();
  return data;
}




function exportOrderData() {

  var exportOrdersBtn = document.querySelector(".exportOrders")

  exportOrdersBtn.addEventListener('click', async function () {

    const orders = await getAllOrders();
    const keys = Object.keys(orders[0])
    const values = []
    let csvContent = ''

    values.push(keys)
    orders.forEach(item => {
      values.push(Object.values(item))
    })

    values.forEach(row => {
      csvContent += row.join(',') + '\n'
    })

    let anchor = document.createElement('a');
    anchor.href = 'data:text/csv;charset=utf-8,' + encodeURI(csvContent);
    anchor.target = '_blank';
    anchor.download = 'orders.csv';
    anchor.click();

  });

}





function displayInvoice() {

  var btns = document.querySelectorAll('.downloadInvoice');

  btns.forEach((btn, i) => {

    btns[i].addEventListener('click', function () {
      var orderId = parseInt($(this).parent().find('#orderId').text());
      var invoice = `../../invoices/InvoiceNr${orderId}.pdf`;
      window.open(invoice, '_blank', 'fullscreen=yes');

    });
  });
}




displayInvoice();
exportOrderData();