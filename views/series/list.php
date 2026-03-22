<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Titre</th>
        <th>Nom court</th>
      <th>Date d'ajout</th>
        <th>Date de modification</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($this->seriesList as $series) { ?>
      <tr>
        <td><?php echo $series->id; ?></td>
        <td><?php echo $series->name; ?></td>
        <td><?php echo $series->short_name; ?></td>
        <td><?php echo $series->created_at; ?></td>
        <td><?php echo $series->updated_at; ?></td>
        <td>
            <a href="/serie/<?php echo $series->short_name; ?>" class="btn btn-info">Voir</a>
          <a href="/modifier-serie/<?php echo $series->short_name; ?>" class="btn btn-warning">Modifier</a>
          <a href="/supprimer-serie/<?php echo $series->short_name; ?>" class="btn btn-danger">Supprimer</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>