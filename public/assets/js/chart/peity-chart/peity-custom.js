var updatingChart = $(".updating-chart").peity("line")

setInterval(function() {
  var random = Math.round(Math.random() * 10)
  var values = updatingChart.text().split(",")
  values.shift()
  values.push(random)

  updatingChart
      .text(values.join(","))
      .change()
}, 1000)

$(".line").peity("line")

$(".bar").peity("bar")

$('.donut').peity('donut')

$(".data-attributes span").peity("donut")

$("span.pie").peity("pie")

$(".bar-colours-1").peity("bar", {
  fill: ["#F59500", "#1ea6ec", "#22af47"],
  width: '100',
  height: '82'
})

$(".bar-colours-2").peity("bar", {
  fill: function(value) {
    return value > 0 ? "#F59500" : "#1ea6ec"
  },
  width: '100',
  height: '82'
})

$(".bar-colours-3").peity("bar", {
  fill: function(_, i, all) {
    var g = parseInt((i / all.length) * 255)
    return "rgb(255, " + g + ", 0)"
  },
  width: '100',
  height: '82'
})

$(".pie-colours-1").peity("pie", {
  fill: ["#F59500", "#1ea6ec", "#ff5370", "#ff9f40"],
  width: '100',
  height: '82'
})
