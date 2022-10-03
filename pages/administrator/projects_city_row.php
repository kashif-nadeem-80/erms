

<script>
    var i = 1;
    $(document).on('click', '.add', function() {
        i++;
        var html = '';
        html += '<tr>';
        html += '<td><select class="form-control select2" id="test_center'+i+'" onchange="getData('+i+')" name="test_center[]" required><option value="">Choose</option><?php $fetchData = "SELECT * FROM projects_test_centers ORDER BY center_name ASC"; $run = mysqli_query($connection,$fetchData); while ($row = mysqli_fetch_array($run)) { $id = $row['id']; $center_name = $row['center_name'];?><option value="<?php echo $id ?>"><?php echo $center_name ?></option><?php } ?></select></td>';
        html += '<td><input type="text" class="form-control" id="capacity'+i+'" disabled placeholder="Capacity"></td>';
        html += '<td><input type="text" class="form-control" id="city'+i+'" disabled placeholder="City"></td>';
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