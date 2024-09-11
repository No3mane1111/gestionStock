
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard des Départements</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        h1 {
            margin-bottom: 20px;
            color: #333;
        }
        .chart-container {
            width: 80%;
            max-width: 800px; /* Réduit la largeur maximale */
            margin-bottom: 40px;
        }
        canvas {
            width: 100% !important; /* Assure que les graphiques utilisent toute la largeur disponible */
            height: 300px !important; /* Réduit la hauteur des graphiques */
        }
    </style>
</head>
<body>
    <h1>Dashboard des Départements</h1>
    <div class="chart-container">
        <h2>Quantité Affectée par Département</h2>
        <canvas id="barChart1"></canvas>
    </div>
    <div class="chart-container">
        <h2>Quantité d'Articles Affectés par Département</h2>
        <canvas id="barChart2"></canvas>
    </div>

    <script>
        // Fonction pour charger les données du fichier PHP
        async function fetchData() {
            const response = await fetch('data.php');
            const data = await response.json();
            return data;
        }

        // Fonction pour créer le premier graphique
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
                        backgroundColor: 'rgba(255, 99, 132, 0.2)', /* Couleur de fond personnalisée */
                        borderColor: 'rgba(255, 99, 132, 1)', /* Couleur de bordure personnalisée */
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

        // Fonction pour créer le deuxième graphique
        async function createChart2() {
            const data = await fetchData();

            const articles = [...new Set(data.chart2.map(item => item.desiArt))];
            const departments = [...new Set(data.chart2.map(item => item.nomDep))];

            const datasets = articles.map(article => {
                return {
                    label: article,
                    data: departments.map(department => {
                        const item = data.chart2.find(d => d.desiArt === article && d.nomDep === department);
                        return item ? item.totalQtAf : 0;
                    }),
                    backgroundColor: getRandomColor(), /* Couleur de fond personnalisée pour chaque dataset */
                    borderColor: 'rgba(0, 0, 0, 0.1)',
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

        // Fonction pour générer une couleur aléatoire
        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Créer les graphiques lorsque la page est chargée
        window.onload = async () => {
            await createChart1();
            await createChart2();
        };
    </script>
</body>
</html>
