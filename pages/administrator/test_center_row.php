<script>
    var i = 1;
    $(document).on('click', '.add', function() {
      i++;
      var html = '';
      html += '<tr>';
      html += '<td><input type="hidden" name="row[]" value="'+i+'"><input type="text" name="room[]" placeholder="Room/Hall Name" class="form-control" required></td>';

      html += '<td><input type="number" name="capacity[]" placeholder="Capacity Per Room" class="form-control" onkeyup="getTotalCap()" id="capacity'+i+'" value="1" required></td>';

      html += '<td><button type="button" name="remove" class="btn btn-sm btn-danger remove"><i class="fa fa-trash"></i></button></td>';

      html += '</tr>';

      $('#item_table').append(html);
      getTotalCap();
    });

    $(document).on('click', '.remove', function() {
      $(this).closest('tr').remove();
      getTotalCap();
    });
    
</script>