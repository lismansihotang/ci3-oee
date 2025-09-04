<div class="row">
    <div class="col-12">
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h4 class="card-title mb-2">Welcome</h4>
                <p class="text-muted">You are logged in as <strong><?php echo html_escape($this->session->userdata('username')); ?></strong>.</p>
            </div>
        </div>
    </div>
</div>