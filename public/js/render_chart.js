$(document).ready(() => {

  // 一人あたりの賃金
  render_income()
});

var render_income = () => {
  // http request
  getJson("/Tax", (response) => {
    console.log(response) 

    var ctx = document.getElementById("incomeChart").getContext('2d');
    const incomeChart =  new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["東京", "岩手"],
        datasets: [{
          label: ' 一人あたりの賃金',
          data: [response["tokyo"]["value"], response["iwate"]["value"]],
          backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(90, 225, 132, 0.2)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
    });
  })
}

// Http Request
function getJson(url, callback) {
  $.ajax({
    url: url,
    dataType: "json"
  }).then(
    // success
    (data) => {
      callback(data)
    },
    (err) => {
      console.log(err)
    }
    );
}
