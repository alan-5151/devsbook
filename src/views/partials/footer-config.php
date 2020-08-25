<div class="modal">
    <div class="modal-inner">
        <a rel="modal:close">&times;</a>
        <div class="modal-content"></div>
    </div>
</div>
<script type="text/javascript">
    const BASE = '<?= $base; ?>';
</script>

<script type="text/javascript" src="<?= $base; ?>/assets/js/script.js"></script>
<script type="text/javascript" src="<?= $base; ?>/assets/js/vanillaModal.js"></script>
  <script src="https://unpkg.com/imask"></script>
        <script>
            IMask(
                    document.getElementById('birthdate'),
                    {
                        mask: '00/00/0000'
                    }
            );
        </script>
</body>
</html>