const mean = async () => {
  try {
    const response = await fetch('/statistics');
    const data = await response.json();

    const result = data.reduce((prev, current) => {
      if (prev[current.degree]) {
        prev[current.degree][current.option] += current.votes;
      } else {
        prev[current.degree] = new Array(6).fill(0);
        prev[current.degree][current.option] = current.votes;
      }
      return prev;
    }, {});

    return Object.entries(result).reduce((means, [degree, votes]) => {
      const totalVotes = votes.reduce((sum, current) => sum + current, 0);
      return {
        [degree]: (votes.reduce((accum, current, index) => ((index + 1) * current + accum), 0) / totalVotes).toFixed(2) - 1, ...means
      };
    }, {});
  } catch (e) {
    return {}
  }
}

const makeBarChart = async () => {
  const ctx = document.getElementById("globalMeans");
  const allMeans = await mean();
  const keys = Object.keys(allMeans);
  const values = Object.values(allMeans);

  const mixedChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: keys,
      datasets: [{
        label: 'Media de cada grado',
        data: values,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }],
    },
    options: {
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
            content: 'Media total ESI'
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

}

document.addEventListener('DOMContentLoaded', makeBarChart, false);