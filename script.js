/* <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script> */
// Chart.js for the ring chart
const ctx = document.getElementById('emotionChart').getContext('2d');
const emotionChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Happy', 'Sad', 'Angry', 'Surprised', 'Neutral'],
        datasets: [{
            data: [30, 20, 15, 25, 10],
            backgroundColor: ['#4caf50', '#f44336', '#ff9800', '#2196f3', '#9e9e9e'],
            hoverOffset: 4
        }]
    },
    options: {
        plugins: {
            legend: {
                position: 'bottom',
            },
        },
        responsive: true,
        cutout: '70%',
    },
});

// Handling input and buttons
document.getElementById('submitMood').addEventListener('click', () => {
    const userMood = document.getElementById('textMood').value;
    if (userMood) {
        alert(`Your mood is: ${userMood}`);
    } else {
        alert('Please enter your mood!');
    }
});

document.getElementById('detectEmotion').addEventListener('click', () => {
    alert('Opening webcam for emotion detection... (Functionality to be implemented)');
});
// </script>


