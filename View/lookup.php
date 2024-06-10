<div class="my-3 card p-3">
    <form method="GET">
        <div class="input-group d-flex flex-nowrap w-100">
            <label class="input-group-text" for="id-field">Select a Target</label>
            <select id="id-field" class="form-select" name="target">
                <?php foreach($this->Return['scans'] as $scan): ?>
                    <option value="<?= $scan['target']; ?>" <?php if(isset($_GET['target']) && $_GET['target'] == $scan['target']){ echo "selected"; } ?>><?= $scan['target']; ?></option>
                <?php endforeach; ?>
            </select>
            <button class="btn btn-success" type="submit">Submit</button>
        </div>
    </form>
</div>
<?php if(isset($this->Return['results'])): ?>
    <div class="pb-3">
        <div class="card p-3">
            <?php foreach($this->Return['results'] as $result): ?>
                <div class="bg-glass border-start border-info border-5 rounded <?php if($result['id'] !== $this->Return['results'][0]['id']){ echo "mt-3"; } ?>">
                    <div class="card-header">
                        <h5 class="card-title w-100 d-flex justify-content-between">
                            <span><?= $result['port'].' '.$result['type'].' '.$result['target']; ?></span>
                            <span><?= $result['timestamp']; ?></span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php foreach(json_decode($result['state'],true) as $state): ?>
                            <p class="card-text">IP: <?= $state; ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
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
    });
</script>
