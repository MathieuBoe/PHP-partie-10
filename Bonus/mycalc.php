

<?php
include "header.php";

?>

    <h1>Une calculatrice en PHP</h1>
    <!-- <form action="index.html" method="post">
      <input type="text" name="chiffre1" value="0"/>
      <input type="text" name="chiffre2" value="0"/>
      <input type="submit" name="addition" value="+"/>
      <input type="submit" name="soustraction" value="-"/>
      <input type="submit" name="multiplication" value="*"/>
      <input type="submit" name="division" value="/"/>
    </form> -->
    <?php 
      function($button, $button1){

      
      ?>
    <div class="calculatrice">
   
      <form action="" method="$_GET">
      <p style="text-align: center;">
    
      <button value="1"> <?php $button1 = 1; ?>1</button> 
      <button value="2"> <?php $button2 = 2; ?>2</button>
      <button value="3"> <?php $button3 = 3; ?>3</button>
    </p>
      <p style="text-align: center;">
      <button value="4"> <?php $button4 = 4; ?>4</button>
      <button value="5"> <?php $button5 = 5; ?>5</button>
      <button value="6"> <?php $button6 = 6; ?>6</button>
    </p>
      <p style="text-align: center;">
      <button value="7"> <?php $button7 = 7; ?>7</button>
      <button value="8"> <?php $button8 = 8; ?>8</button>
      <button value="9"> <?php $button9 = 9; ?>9</button>
    </p>
      <p style="text-align: center;">
      <button value="0"> <?php $button0 = 0; ?>0</button></p>
      <p style="text-align: center;">
      <button value="+"> <?php $buttonplus = '+'; ?>+</button>
      <button value="-"> <?php $buttonminus = '-'; ?>-</button>
      <button value="*"> <?php $buttonmultiply = '*'; ?>*</button>
      <button value="/"> <?php $buttondivided = '/'; ?>/</button>
    </p>
    <p style="text-align: center;">
      <input type="submit" name="=" id="=" value="=">
    </p>
    <p><?= </p>
    <p><?php echo $_GET[button];?></p>
    </form>
    </div>
  <?php }; 
  include "footer.php";
  ?>
 
