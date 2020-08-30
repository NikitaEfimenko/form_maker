<div class="card">
  <header style='padding:8px'>
    <form method='POST' action='/builder/add'>
      <button type='submit'>+</button>
      <select type='select' name='type'>
        <option selected value='text'>Текстовое поле</option>
        <option value='check'>Чекбокс</option>
        <option value='select'>Выпадающий список</option>
      </select>
      <input type='text' name='label'>
    </form>
  </header>
  <div style='display:grid; width:300px'>
      <div style='padding: 24px;border: 1px solid #eee; border-left: none; border-right: none'>
      <?php 
        foreach ($FORMS as $key => $value) {
          echo $value;
        }
      ?>
      </div>
  </div>
  <footer style='display:flex; padding: 8px'>
  <div>
        <span>to:</span>
        <input type='text' form='submit' name='email'>
      </div>  
  <form id='submit' method='post' action='/builder/publish'>
      <button type='submit'>publish</button>
    </form>
    <form method='post' action='/builder/reset'>
      <button type='submit'>reset</button>
    </form>
  </footer>
</div>