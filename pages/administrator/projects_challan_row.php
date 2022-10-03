

<script>
    var i = 1;
    $(document).on('click', '.add', function() {
        i++;
        var html = '';
        html += '<tr>';
        html += '<td><select class="form-control select2" onchange="getBPS('+i+')" id="post'+i+'" name="post[]" required><option value="">Choose</option><?php $fetchData = "SELECT * FROM projects_posts WHERE project_id = '$proj_id'"; $run = mysqli_query($connection,$fetchData); while ($row = mysqli_fetch_array($run)) { $id = $row['id']; $name = $row['post_name']; ?> <option value="<?php echo $id ?>"><?php echo $name ?></option> <?php } ?></select></td>';
        html += '<td><input type="text" class="form-control" id="bps'+i+'" name="bps[]" id="bps1" readonly></td>';
        html += '<td><button type="button" name="remove" class="btn btn-sm btn-danger remove"><i class="fa fa-trash"></i></button></td>';
        html += '</tr>';
        $('#item_table').append(html);
    });

    $(document).on('click', '.remove', function() {
        $(this).closest('tr').remove();
    });
</script>