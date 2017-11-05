const pref = {
  "iwate": 3,
  "tokyo": 13
}

var selectedCity = {
  "iwate": {
  },
  "tokyo": {
  }
}

var populationChart
var incomeChart
var natureChart

$(document).ready(() => {

  update_chart()
  render()

  $('#iwate-city').change(function() {
    update_chart()
    render()
  });

  $('#tokyo-city').change(function() {
    update_chart()
    render()
  });
});

function render() {

  render_nature()

  // 昼夜間人口比率
  render_population()

  // 一人あたりの賃金
  render_income()
}

function update_chart() {
  selectedCity["iwate"]["code"] = $('[name=iwateCity]').val()
  selectedCity["iwate"]["name"] = $('[name=iwateCity] option:selected').text()
  selectedCity["tokyo"]["code"] = $('[name=tokyoCity]').val()
  selectedCity["tokyo"]["name"] = $('[name=tokyoCity] option:selected').text()
}

var render_nature = () => {
    // http request
    getJson(`./Land?firstPrefCode=${pref['iwate']}&firstCityCode=${selectedCity['iwate']['code']}&secondPrefCode=${pref['tokyo']}&secondCityCode=${selectedCity['tokyo']['code']}`, (response) => {
      console.log(response)

      var ctx = document.getElementById("natureChart").getContext('2d');
      natureChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ["岩手", "東京"],
          datasets: [{
            label: '自然の豊かさ（森林と野原の量）',
            data: [response["iwate"]["statearea"], response["tokyo"]["statearea"]],
            backgroundColor: [
            'rgba(90, 225, 132, 0.2)',
            'rgba(255, 99, 132, 0.2)',
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

  var render_population = () => {
    const url = `./Population?firstPrefCode=${pref['iwate']}&firstCityCode=${selectedCity['iwate']['code']}&secondPrefCode=${pref['tokyo']}&secondCityCode=${selectedCity['tokyo']['code']}`
    console.log(url)
    getJson(url, (response) => {

      var ctx = document.getElementById("populationChart").getContext('2d');

      if( populationChart ){
       populationChart.destroy();
     }

     populationChart =  new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [`岩手県${selectedCity['iwate']['name']}-昼`, `岩手県${selectedCity['iwate']['name']}-夜`, `東京都${selectedCity['tokyo']['name']}-昼`, `東京都${selectedCity['tokyo']['name']}-夜`],
        datasets: [{
          label: '中夜間人口比率',
          data: [response["iwate"]["noonDataSum"], response["iwate"]["nightDataSum"], response["tokyo"]["noonDataSum"], response["tokyo"]["nightDataSum"]],
          backgroundColor: [
          'rgba(90, 225, 132, 0.2)',
          'rgba(90, 225, 132, 0.6)',
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 99, 132, 0.6)',
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

