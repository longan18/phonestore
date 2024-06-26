import Chart from 'chart.js/auto';


const ctx = document.getElementById('lineChartDemo').getContext('2d');  // Lấy dữ liệu từ PHP

const orderChart = new Chart(ctx, {
    type: 'bar', // Chọn loại biểu đồ là bar
    data: {
        labels: data.map(item => item.week),
        datasets: [{
            label: 'Tổng đơn hàng chưa thanh toán đã giao thành công',
            data: data.map(item => item.total),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true, // Bắt đầu trục y từ 0
                ticks: {
                    callback: function(value, index, values) {
                        return value.toLocaleString(); // Định dạng giá trị trên trục y
                    }
                }
            },
            x: {
                ticks: {
                    autoSkip: false,
                    maxRotation: 45
                }
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.dataset.label || '';

                        if (label) {
                            label += ': ';
                        }
                        label += context.parsed.y.toLocaleString(); // Định dạng giá trị trong tooltip
                        return label;
                    }
                }
            }
        }
    }
});

