/*
const resas_endpoint = "https://opendata.resas-portal.go.jp/"
const headers = {"X-API-KEY" : "UPX5SZobrRouNAHKJksmpsixcgtDbcQfPXCo2UV9" }
const prefCode = {
  "iwate" : "",
  "tokyo" : ""
}

$(document).ready(() => {

getJson("api/v1/forestry/land/forStacked", render_nature_area)
});

var render_nature_area = (region, raw_json) => {
  const chart_data = {

  } 

  var ctx = document.getElementById("myChart").getContext('2d');
}

// 不動産取引価格
function getJson(api_url, callback) {
  $.ajax({
    url: resas_endpoint + api_url,
    headers: headers,
    dataType: "json",
    success: ( result ) => {
      callback(result)
    }
  });
}
*/
