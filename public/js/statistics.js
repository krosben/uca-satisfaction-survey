import { disableFieldsById, hideOptionsFromSelectByData } from './tools.js';

const backgroundColors = [
  'rgba(255, 99, 132, 0.2)',
  'rgba(54, 162, 235, 0.2)',
  'rgba(255, 206, 86, 0.2)',
  'rgba(75, 192, 192, 0.2)',
  'rgba(153, 102, 255, 0.2)',
  'rgba(255, 159, 64, 0.2)',
];

const borderColors = [
  'rgba(255, 99, 132, 1)',
  'rgba(54, 162, 235, 1)',
  'rgba(255, 206, 86, 1)',
  'rgba(75, 192, 192, 1)',
  'rgba(153, 102, 255, 1)',
  'rgba(255, 159, 64, 1)',
];

const getData = async (params) => {
  const response = await fetch('/statistics', {
    method: 'post',
    body: JSON.stringify(params),
    headers: {
      'Content-Type': 'application/json'
    }
  });
  return response.json();
}

const updateChart = async (
  label,
  params = { id_degree: null },
  colors = { backgroundColors: 'rgba(255, 159, 64, 0.2)', borderColors: 'rgba(255, 159, 64, 1)' }
) => {
  const data = await getData(params);
  const values = Object.values(data);
  window.mixedChart.data.datasets[0].backgroundColor = colors.backgroundColors;
  window.mixedChart.data.datasets[0].borderColor = colors.borderColors;
  window.mixedChart.data.labels = Object.keys(data);
  window.mixedChart.data.datasets[0].data = values;
  window.mixedChart.options.annotation.annotations[0].label.content = label;
  window.mixedChart.options.annotation.annotations[0].value = values.reduce((prev, current) => prev + current, 0) / values.length;
  window.mixedChart.update();
}

window.addEventListener('load', async () => {
  disableFieldsById([
    document.getElementById("subject-id"),
    document.getElementById("proffesor-id"),
  ], 'degree-id')

  const ctx = document.getElementById("visualization").getContext("2d");
  const means = await getData({ id_degree: null })

  const keys = Object.keys(means);
  const values = Object.values(means);

  window.mixedChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: keys,
      datasets: [{
        data: values,
        backgroundColor: backgroundColors,
        borderColor: borderColors,
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

let params = { id_degree: null }

document.getElementById("degree-id").addEventListener("change", async (event) => {
  document.getElementById("subject-id").selectedIndex = 0;
  disableFieldsById([document.querySelector("#subject-id")], 'degree-id');
  if (event.target.value) {
    params.id_degree = event.target.value;
    await updateChart("Media Grado", params);
  }
  hideOptionsFromSelectByData('#subject-id', 'degree-id', 'idDegree', [document.querySelector('#subject-id')])(event);
});

document.getElementById("subject-id").addEventListener("change", async (event) => {
  document.getElementById("proffesor-id").selectedIndex = 0;
  if (event.target.value) {
    params.id_subject = event.target.value;
    await updateChart("Media Asignatura", params);
  }
  hideOptionsFromSelectByData('#proffesor-id', 'subject-id', 'idSubject', [document.querySelector('#proffesor-id')])(event);

});

document.getElementById("proffesor-id").addEventListener("change", async (event) => {
  if (event.target.value) {
    params.id_proffesor = event.target.value;
    await updateChart("Media Profesor", params);
  }
});

document.getElementById("age-id").addEventListener("change", async (event) => {
  if (event.target.value) {
    params.age = event.target.value;
    if (document.getElementById("degree-id").selectedIndex === 0) {
      await updateChart("Media estudiantes con " + params.age, params, { backgroundColors, borderColors });
    } else {
      await updateChart("Media estudiantes con " + params.age, params);
    }
  }
})

document.getElementById("gender-id").addEventListener("change", async (event) => {
  if (event.target.value) {
    params.id_gender = event.target.value;
    if (document.getElementById("degree-id").selectedIndex === 0) {
      await updateChart("Media estudiantes " + params.id_gender, params, { backgroundColors, borderColors });
    } else {
      await updateChart("Media estudiantes " + params.id_gender, params);
    }
  }
})

document.getElementById("clean-filters").addEventListener("click", async () => {
  const filtersIds = ["degree-id", "subject-id", "proffesor-id", "gender-id"];
  filtersIds.forEach(filterId => { document.getElementById(filterId).selectedIndex = 0 });
  document.getElementById("age-id").value = null;

  disableFieldsById([
    document.querySelector("#subject-id"),
    document.getElementById("proffesor-id")
  ], 'degree-id');
  params = { id_degree: null };
  await updateChart("Media ESI", params, { backgroundColors, borderColors });
})