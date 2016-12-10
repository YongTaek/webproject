<link rel="stylesheet" href="/public/css/sidebar.css" type="text/css">
<script type="text/javascript">
  <?php if (isset($_SESSION["id"]) && isset($_SESSION["favQuestion"]) && isset($_SESSION["openLecture"])) {
  ?>
  var questionArray = <?php echo json_encode($_SESSION["favQuestion"]); ?>;
  var lectureArray = <?php echo json_encode($_SESSION["openLecture"]); ?>;
  <?php } ?>

</script>
