<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                {{ date('Y') }} © {{ getenv('APP_NAME') }}.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-right d-none d-sm-block">
                    Crafted with <i class="mdi mdi-heart text-danger"></i> by {{ getenv('APP_NAME') }}
                </div>
            </div>
        </div>
    </div>
</footer>
