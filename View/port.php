<div class="my-3 card p-3">
    <form method="GET">
        <div class="input-group d-flex flex-nowrap w-100">
            <label class="input-group-text" for="id-field">Select a Target</label>
            <select id="id-field" class="form-select" name="target">
                <?php foreach($this->Return['scans'] as $scan): ?>
                    <option value="<?= $scan['target'].':'.$scan['port']; ?>" <?php if(isset($_GET['target']) && $_GET['target'] == $scan['target'].':'.$scan['port']){ echo "selected"; } ?>><?= $scan['target'].':'.$scan['port']; ?></option>
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
                        type: 'time',
                        time: {
                            unit: 'minute',
                            stepSize: 5,
                            displayFormats: {
                                hour: 'HH:mm',
                                minute: 'HH:mm',
                            }
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 1)' // Grid color
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 1)', // Labels text color
                            callback: function(value, index, values) {
                                // Convert datetime to time
                                var date = new Date(value);
                                return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                            }
                        }
                    },
                    y: {
                        min: 0,
                        max: 1,
                        grid: {
                            color: 'rgba(255, 255, 255, 1)' // Grid color
                        },
                        ticks: {
                            color: 'rgba(255, 255, 255, 1)', // Labels text color
                            callback: function(value, index, values) {
                                return value === 1 ? 'Open' : value === 0 ? 'Closed' : '';
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'rgba(255, 255, 255, 1)', // Legend text color
                            font: {
                                size: 14,
                            },
                            borderColor: 'rgba(255, 255, 255, 1)' // Not directly applicable to labels, but showing how to set options
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.raw === 1 ? 'Open' : 'Closed';
                            }
                        }
                    }
                }
            },
        });
    });
</script>
