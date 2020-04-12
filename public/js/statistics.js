import { disableFieldsById, hideOptionsFromSelectByData } from './tools.js';

const getData = async (params = { degree: null }) => {
  const response = await fetch('/statistics', {
    method: 'post',
    body: JSON.stringify(params),
    headers: {
      'Content-Type': 'application/json'
    }
  });
  return response.json();
}

const mean = async () => getData();

const meanOfDegree = async () => {
  const degree = document.getElementById("degree-id").value;
  if (degree) {
    return getData({ degree });
  }
}

const updateChart = (method, label) => async () => {
  const data = await method();
  const values = Object.values(data);
  window.mixedChart.data.datasets[0].backgroundColor = 'rgba(255, 159, 64, 0.2)';
  window.mixedChart.data.datasets[0].borderColor = 'rgba(255, 159, 64, 1)';
  window.mixedChart.data.labels = Object.keys(data);
  window.mixedChart.data.datasets[0].data = values;
  window.mixedChart.options.annotation.annotations[0].label.content = label;
  window.mixedChart.options.annotation.annotations[0].value = values.reduce((prev, current) => prev + current, 0) / values.length;
  window.mixedChart.update();
}

window.addEventListener('load', async () => {
  const ctx = document.getElementById("visualization").getContext("2d");
  const means = await mean()

  const keys = Object.keys(means);
  const values = Object.values(means);

  window.mixedChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: keys,
      datasets: [{
        data: values,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
        ],
        borderWidth: 1
      }],
    },
    options: {
      legend: {
        display: false
      },
      annotation: {
        annotations: [{
          type: 'line',
          mode: 'horizontal',
          scaleID: 'y-axis-0',
          value: values.reduce((prev, current) => prev + current, 0) / values.length,
          borderColor: 'rgb(75, 192, 192)',
          borderWidth: 2,
          label: {
            enabled: true,
            content: "Media ESI"
          }
        }]
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            suggestedMin: 0,
            suggestedMax: 5,
          }
        }]
      }
    }
  })
})



document.getElementById("degree-id").addEventListener("change",
  async () => {
    disableFieldsById([document.querySelector("#subject-id")], 'degree-id');
    await updateChart(meanOfDegree, "Media Grado")();
  }
);

document.getElementById("degree-id").addEventListener(
  "change",
  hideOptionsFromSelectByData('#subject-id', 'degree-id', 'idDegree', [document.querySelector('#subject-id')])
);

document.getElementById("degree-id").addEventListener("change", () => {
  document.getElementById("subject-id").selectedIndex = 0;
});
