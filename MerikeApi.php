<?php
include "./header.php";

$fileName = 'Merike.json';
$cacheTime = 5;
print $data;
$data;

if (file_exists($fileName) && (time() - filemtime($fileName) < $cacheTime)) {
    $data = file_get_contents($fileName);
} else {
    $data = file_get_contents("https://ta18toose.itmajakas.ee/Hajusrakendused/lemmikAPI/api.php?limit=14");

    if (!$data) {
        return;
    }
    file_put_contents($fileName, $data);
}
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-image">
                <thead>
                    <tr>
                        <th scope="col">Foto</th>
                        <th scope="col">Pealkiri</th>
                        <th scope="col">Kirjeldus</th>
                        <th scope="col">Raskus</th>
                        <th scope="col">Loodud</th>
                    </tr>
                </thead>
                <tbody>
                    <div id="data">

                        <?php
                        foreach (json_decode($data) as $i) :
                        ?>
                            <td class="w-25"><img src="<?php echo $i->image ?>" style="width: auto; height:300px" class="image"></td>
                            <th><?php echo $i->title ?></th>
                            <td><?php echo $i->description ?></td>
                            <td><?php echo $i->difficulty ?></td>
                            <td><?php echo $i->made_at ?></td>
                            </tr>
                            <tr>
                            <?php endforeach; ?>
                    </div>
                </tbody>
            </table>

        </div>
    </div>
</div>