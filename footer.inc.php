<!--//hitPage(1); -->
<div class="container">
  <footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
      <div class="col-12 col-md">
        <?php echo "<h6>Date de dernière modification le " . $datem . " à Université de Cergy-Pontoise</h6>\n"; ?>
        <a class="sommaire-item" href="#">Retour au haut de page</a>
      </div>
      <div class="col-6 col-md">
        <?php echo "<h5>Page WEB réalisé par</h5>\n"; ?>
        <ul class="list-unstyled text-small">
          <li class="text-muted">ROMDHANI Ryan</li>
          <li class="text-muted">LASLAH Samy</li>
          <li class="text-muted">BOUCCEREDJ Sami</li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>Date du jour</h5>
        <ul class="list-unstyled text-small">
          <?php echo "<li class=\"text-muted\">" . dateDuJour("fr") . "</li>"; ?>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>Votre navigateur est</h5>
        <ul class="list-unstyled text-small">
          <?php echo "<li class=\"text-muted\">" . get_navigateur() . "</li>"; ?>
        </ul>
      </div>
    </div>
  </footer>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>