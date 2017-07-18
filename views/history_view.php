
<table class="table table-striped">
    <thead> 
        <tr>
            <th>Focus</th>
            <th>SubFocus</th>
            <th>Date</th>
            <th>Start</th>
            <th>End</th>
            <th>Time (Min.)</th>
        </tr>
    
    </thead>
    
    <tbody>

    <?php foreach($positions as $position): ?>
        
        <tr class="alignleft">
            <td><?=$position["focus"] ?></td>
            <td><?=$position["subfocus"] ?></td>
            <td><?=$position["date"] ?></td>
            <td><?=$position["start"] ?></td>
            <td><?=$position["end"] ?></td>
            <td><?=$position["time"] ?></td>
            
        </tr>
    
    <?php endforeach ?>
    
    
    </tbody>

</table>

