<script>
    $(function(){
        $('.alert .close').click(function(){
            var alert = $(this).closest('.alert')
                alert.hide('fadeOut')
                setTimeout(() => {
                    alert.remove()
                }, 1000);
        })
    })
</script>
</body>
</html>