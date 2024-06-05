<form method="GET">
    <select name="id">
        <?php foreach($this->Return['scans'] as $scan): ?>
            <option value="<?= $scan['id']; ?>"><?= $scan['type']; ?>: <?= $scan['target']; ?>:<?= $scan['port']; ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Submit</button>
</form>
<canvas id="resultsChart" style="max-height:500px;"></canvas>
<script>
    $(document).ready(function(){
        // Results Chart
        const ctx = document.getElementById('resultsChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($this->Return['chart']['labels']); ?>,
                datasets: <?php echo json_encode(array_values($this->Return['chart']['datasets'])); ?>
            },
            options: {
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 1)' // Grid color
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 1)' // Labels text color
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(255, 255, 255, 1)' // Grid color
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 1)' // Labels text color
                        }
                    }
                }
            },
        });
    });
</script>
