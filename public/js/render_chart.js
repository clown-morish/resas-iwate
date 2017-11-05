var iwatePref = 3
var tokyoPref = 13
var iwateCity
var tokyoCity
var populationChart
var incomeChart

$(document).ready(() => {

  iwateCity = $('[name=iwateCity]').val()
  tokyoCity = $('[name=tokyoCity]').val()

  render()

  $('#iwate-city').change(function() {
    console.log("fnit")
    // 選択されているvalue属性値を取り出す
    iwateCity = $('[name=iwateCity]').val()
    render()
  });

  $('#tokyo-city').change(function() {
    console.log("fffni")
      // 選択されているvalue属性値を取り出す
      tokyoCity = $('[name=tokyoCity]').val()
      render()
    });
});

function render() {
  console.log("in reander")
  // 昼夜間人口比率
  render_population()

  render_nature()

  // 一人あたりの賃金
  render_income()
}

var render_population = () => {
  const url = `./Population?firstPrefCode=${iwatePref}&firstCityCode=${iwateCity}&secondPrefCode=${tokyoPref}&secondCityCode=${tokyoCity}`
  console.log(url)
  getJson(url, (response) => {

    var ctx = document.getElementById("populationChart").getContext('2d');

    if( populationChart ){
     populationChart.destroy();
   }

   populationChart =  new Chart(ctx, {
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
    // http request
    getJson(`./Land?firstPrefCode=${iwatePref}&firstCityCode=${iwateCity}&secondPrefCode=${tokyoPref}&secondCityCode=${tokyoCity}`, (response) => {
      console.log(response)

      var ctx = document.getElementById("natureChart").getContext('2d');
      const incomeChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ["東京", "岩手"],
          datasets: [{
            label: '自然の豊かさ（森林と野原の量）',
            data: [response["tokyo"]["statearea"], response["iwate"]["statearea"]],
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
                beginAtZero: true
              }
            }]
          }
        }
      });
    })
  }

var render_income = () => {
  // http request
  getJson("./Tax", (response) => {
    console.log(response) 

    var ctx = document.getElementById("incomeChart").getContext('2d');

    if( incomeChart ){
     incomeChart.destroy();
   }

   incomeChart =  new Chart(ctx, {
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


