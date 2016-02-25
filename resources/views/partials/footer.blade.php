<!-- Footer -->
<footer>
    <div class="row social">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            @include('partials.socialConnect')
            <p class="copyright text-muted text-center">Copyright &copy; {{ $info->blog_name }} <?php echo date('Y'); ?></p>
        </div>
    </div>
</footer>