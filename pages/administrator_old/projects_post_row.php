

<script>
    var i = 1;
    $(document).on('click', '.add', function() {
        i++;
        var html = '';
        html += '<tr>';
        html += '<td><input type="text" name="post_name[]" placeholder="Post Name" class="form-control" required></td>';
        html += '<td><input type="text" name="post_bps[]" placeholder="BPS" class="form-control" required></td>';
        html += '<td><input type="text" name="no_of_posts[]" placeholder="No of Posts" class="form-control" required></td>';
        html += '<td><select class="form-control select2" name="challan[]" required><option value="">Choose</option><?php $fetch1 = "SELECT id, challan_title FROM projects_challans WHERE project_id = '$proj_id'"; $run1 = mysqli_query($connection,$fetch1); while($row1 = mysqli_fetch_array($run1)) { $id  = $row1['id']; $challan_title  = $row1['challan_title']; ?><option value="<?php echo $id ?>"><?php echo $challan_title ?></option><?php } ?></select></td>';
        html += '<td><button type="button" name="remove" '+i+' class="btn btn-sm btn-danger remove"><i class="fa fa-trash"></i></button></td>';
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