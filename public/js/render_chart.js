$(document).ready(() => {
  
  // 昼夜間人口比率
  render_population()

  render_nature()

  // 一人あたりの賃金
  render_income()
});

var render_population = () => {
  getJson("/Population", (response) => {

    var ctx = document.getElementById("populationChart").getContext('2d');

    const populationChart =  new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["岩手-昼", "岩手-夜", "東京-昼", "東京-夜"],
        datasets: [{
          label: '中夜間人口比率',
          data: [response["iwate"]["noonDataSum"], response["iwate"]["nightDataSum"], response["tokyo"]["noonDataSum"], response["tokyo"]["nightDataSum"]],
          backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(90, 225, 132, 0.2)',
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
  });
}

var render_nature = () => {

}

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
