

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';


// Récupérer le fichier .csv avec fetch()
fetch('../../../back/data2.csv')
  .then(response => response.text())
  .then(datas => {
    // Analyser les données avec Papa Parse
    //var parsedData = Papa.parse(datas, { header: true });

    // Extraire les valeurs correspondant aux clés 'PB1', 'PB2' et 'PB3'
    //var rank1Value = parsedData.data.find(row => row.idUser === 'rank1').value;
    //var rank2Value = parsedData.data.find(row => row.idUser === 'rank2').value;
    //var rank3Value = parsedData.data.find(row => row.idUser === 'rank3').value;
    const datasets = [];

    // const playerName = Object.keys(playerRanks)[0];
    // const playerName2 = Object.keys(playerRanks)[1];
    // const playerName3 = Object.keys(playerRanks)[2];
    const color_cd = `rgba(${215},${125},${128},1)`;
    const color_timer = `rgba(${113},${211},${167},1)`;
    const color_QTE = `rgba(${172},${158},${201},1)`;
    const backgroundColor = [color_cd,color_timer,color_QTE]
    const borderColor = `rgba(${51},${51},${51},1)`;
    const data = [[50],[100],[150]];

    datasets.push({
      label: "Rank",
      backgroundColor,
      borderColor,
      borderWidth: 1,
      data,
    });
  

    // Create chart
    const ctx = document.getElementById("myBarChart");
    const myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Countdown", "Timer", "QTE"],
        datasets,
      },
      options: {
        scales: {
          xAxes: [{
            time: {
              unit: 'game',
            },
            gridLines: {
              display: false,
            },
            ticks: {
              maxTicksLimit: 3,
            },
          }],
          yAxes: [{
            ticks: {
              min: 1,
              max: 250,
              maxTicksLimit: 10,
            },
            gridLines: {
              display: true,
            },
          }],
        },
        legend: {
          display: false,
        },
      },
    });
  })
  .catch(error => console.error(error));
