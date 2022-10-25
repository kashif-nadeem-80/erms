<script>
    var i = 1;
    $(document).on('click', '.add', function() {
      i++;
      var html = '';
      html += '<tr>';
      html += '<td><select class="form-control select2" onchange="getChallan('+i+')" name="proj_id[]" id="projID'+i+'" required><option value="">Choose</option><?php $fetch1 = "SELECT id, project_id FROM projects WHERE status = '1' ORDER BY id DESC"; $run1 = mysqli_query($connection,$fetch1); while($row1 = mysqli_fetch_array($run1)) { $id  = $row1['id']; $project_id  = $row1['project_id']; ?> <option value="<?php echo $id ?>"><?php echo $project_id ?></option> <?php } ?></select></td>';
      html += '<td><input type="text" name="post_name[]" placeholder="Post Name" class="form-control" required></td>';
      html += '<td><input type="text" name="post_bps[]" placeholder="BPS" class="form-control" required></td>';
      html += '<td><input type="text" name="no_of_posts[]" placeholder="No of Posts" class="form-control" required></td>';
      html += '<td><select class="form-control select2" id="chalanID'+i+'" name="challan[]" required><option value="">First Select Project</option></select></td>';
      html += '<td><button type="button" name="remove" class="btn btn-sm btn-danger remove"><i class="fa fa-trash"></i></button></td>';
      html += '</tr>';
      $('#item_table').append(html);
      $('.select2').select2({
        theme: 'bootstrap4'
      });
    });

    $(document).on('click', '.remove', function() {
      $(this).closest('tr').remove();
    });
    
</script>