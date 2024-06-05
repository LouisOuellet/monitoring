
<div class="my-3 card p-3">
    <form method="GET">
        <div class="input-group d-flex flex-nowrap w-100">
            <label class="input-group-text" for="id-field">Select a Scan</label>
            <select id="id-field" class="form-select" name="id">
                <?php foreach($this->Return['scans'] as $scan): ?>
                    <option value="<?= $scan['id']; ?>" <?php if(isset($_GET['id']) && $_GET['id'] == $scan['id']){ echo "selected"; } ?>><?= $scan['type']; ?>: <?= $scan['target']; ?>:<?= $scan['port']; ?></option>
                <?php endforeach; ?>
            </select>
            <button class="btn btn-success" type="submit">Submit</button>
        </div>
    </form>
</div>
<div class="my-3 card p-3">
    <canvas id="resultsChart" style="max-height:500px;"></canvas>
</div>
<script>
    $(document).ready(function(){

        // Initialize the Select2 plugin
        $('#id-field').select2({
            theme: 'bootstrap-5',
            width: '100%',
            dropdownAutoWidth: true,
            placeholder: 'Select a Scan',
            allowClear: true
        });

        // Results Chart
        const ctx = document.getElementById('resultsChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php if(isset($this->Return['chart'],$this->Return['chart']['labels'])){ echo json_encode($this->Return['chart']['labels']); } else { echo '[]'; } ?>,
                datasets: <?php if(isset($this->Return['chart'],$this->Return['chart']['datasets'])){ echo json_encode(array_values($this->Return['chart']['datasets'])); } else { echo '[]'; } ?>
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
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'rgba(255, 255, 255, 1)', // Legend text color
                            font: {
                                size: 14,
                                family: 'Arial',
                                style: 'italic',
                                weight: 'bold'
                            },
                            borderColor: 'rgba(255, 255, 255, 1)' // Not directly applicable to labels, but showing how to set options
                        }
                    }
                }
            },
        });
    });
</script>
