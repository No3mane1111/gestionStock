<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard des Départements</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 80%;
            height: 400px;
            margin: auto;
        }
        .home-content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <?php include "entete.php"; ?>
    <h1>Dashboard des Départements</h1>

    <div class="chart-container">
        <h2>Prix des Commandes par Département</h2>
        <canvas id="barChart4"></canvas>
    </div>
    <div class="chart-container">
        <h2>Quantité Affectée par Département</h2>
        <canvas id="barChart1"></canvas>
    </div>
    <div class="chart-container">
        <h2>Quantité d'Articles Affectés par Département</h2>
        <canvas id="barChart2"></canvas>
    </div>
    <div class="chart-container">
        <h2>Quantité Affectée par Département par Mois</h2>
        <canvas id="lineChart"></canvas>
    </div>
    

    <script>
        async function fetchData() {
            const response = await fetch('data.php');
            const data = await response.json();
            return data;
        }
        async function createChart4() {
            const data = await fetchData();
            const labels = data.chart4.map(item => item.nomDep);
            const values = data.chart4.map(item => item.totalPrixCom);

            const ctx = document.getElementById('barChart4').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Prix des Commandes',
                        data: values,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Département',
                                color: '#333',
                                font: {
                                    size: 14
                                }
                            },
                            ticks: {
                                color: '#666'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Prix Com',
                                color: '#333',
                                font: {
                                    size: 14
                                }
                            },
                            ticks: {
                                color: '#666'
                            }
                        }
                    }
                }
            });
        }

        async function createChart1() {
            const data = await fetchData();
            const labels = data.chart1.map(item => item.nomDep);
            const values = data.chart1.map(item => item.totalQtAf);

            const ctx = document.getElementById('barChart1').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Quantité Affectée',
                        data: values,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Département',
                                color: '#333',
                                font: {
                                    size: 14
                                }
                            },
                            ticks: {
                                color: '#666'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Quantité',
                                color: '#333',
                                font: {
                                    size: 14
                                }
                            },
                            ticks: {
                                color: '#666'
                            }
                        }
                    }
                }
            });
        }

        async function createChart2() {
            const data = await fetchData();
            const articles = [...new Set(data.chart2.map(item => item.desiArt))];
            const departments = [...new Set(data.chart2.map(item => item.nomDep))];

            const colors = [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ];

            const borderColor = [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ];

            const datasets = articles.map((article, index) => {
                return {
                    label: article,
                    data: departments.map(department => {
                        const item = data.chart2.find(d => d.desiArt === article && d.nomDep === department);
                        return item ? item.totalQtAf : 0;
                    }),
                    backgroundColor: colors[index % colors.length],
                    borderColor: borderColor[index % borderColor.length],
                    borderWidth: 1
                };
            });

            const ctx = document.getElementById('barChart2').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: departments,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true,
                            stacked: true,
                            title: {
                                display: true,
                                text: 'Département',
                                color: '#333',
                                font: {
                                    size: 14
                                }
                            },
                            ticks: {
                                color: '#666'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            stacked: true,
                            title: {
                                display: true,
                                text: 'Quantité',
                                color: '#333',
                                font: {
                                    size: 14
                                }
                            },
                            ticks: {
                                color: '#666'
                            }
                        }
                    }
                }
            });
        }

        async function createLineChart() {
            const data = await fetchData();
            const departments = [...new Set(data.lineChart.map(item => item.nomDep))];
            const months = Array.from({length: 12}, (v, k) => k + 1);

            const colors = [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ];

            const datasets = departments.map((department, index) => {
                return {
                    label: department,
                    data: months.map(month => {
                        const item = data.lineChart.find(d => d.nomDep === department && d.mois === month);
                        return item ? item.totalQtAf : 0;
                    }),
                    fill: false,
                    borderColor: colors[index % colors.length],
                    tension: 0.1
                };
            });

            const ctx = document.getElementById('lineChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: months.map(m => `Mois ${m}`),
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Mois',
                                color: '#333',
                                font: {
                                    size: 14
                                }
                            },
                            ticks: {
                                color: '#666'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Quantité',
                                color: '#333',
                                font: {
                                    size: 14
                                }
                            },
                            ticks: {
                                color: '#666'
                            }
                        }
                    }
                }
            });
        }

        

        window.onload = async () => {
            await createChart1();
            await createChart2();
            await createLineChart();
            await createChart4();
        };
    </script>
    <?php include 'pied.php'; ?>
</body>
</html>
