
<div class="page_page">
    <?php if ($current_page > 3) {
        $first_page = 1 ?>

        <a class="page-item" href="?per_page=<?= $page ?>&page=<?= $first_page ?><?php if(isset($id1)){echo '&id='.$id1;} ?>">first</a>
    <?php } ?>
    <?php if ($current_page > 1) {
        $pre_page = $current_page - 1 ?>
        <a class="page-item" href="?per_page=<?= $page ?>&page=<?= $pre_page ?><?php if(isset($id1)){echo '&id='.$id1;} ?>"><i class="fas fa-chevron-left"></i></a>
    <?php } ?>
    <?php for ($num = 1; $num <= $total_page; $num++) { ?>
        <?php if ($num != $current_page) { ?>
            <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                <a class="page-item" href="?per_page=<?= $page ?>&page=<?= $num ?><?php if(isset($id1)){echo '&id='.$id1;} ?>"><?= $num ?></a>
            <?php } ?>
        <?php } else { ?>
            <strong class="page-item-current page-item"><?= $num ?></strong>
        <?php } ?>
    <?php } ?>
    <?php if ($current_page <= $total_page - 1) {
        $next_page = $current_page + 1 ?>
        <a class="page-item" href="?per_page=<?= $page ?>&page=<?= $next_page ?><?php if(isset($id1)){echo '&id='.$id1;} ?>"><i class="fas fa-chevron-right"></i></a>
    <?php } ?>
    <?php if ($current_page < $total_page - 3) {
        $end_page = $total_page ?>
        <a class="page-item" href="?per_page=<?= $page ?>&page=<?= $end_page ?><?php if(isset($id1)){echo '&id='.$id1;} ?>">end</a>
    <?php } ?>
</div>