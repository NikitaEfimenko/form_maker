<div class="content">
  <form method='POST' <?php echo "action='/form/".$UID."/submit'" ?>>
    <?php
      foreach ($FORMS as $key => $value) {
        echo $value;
      }
    ?>
    <br>
    <button type='submit'>submit</button>
  </form>
</div>