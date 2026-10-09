<?php
require 'db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    http_response_code(400);
    exit('Vigane raamatu ID.');
}

$query = $pdo->prepare('SELECT * FROM books WHERE id = ?');
$query->execute([$id]);
$book = $query->fetch();
if (!$book) {
    http_response_code(404);
    exit('Raamatut ei leitud.');
}

$form = $book;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($form as $field => $value) {
        $form[$field] = trim((string) ($_POST[$field] ?? $value));
    }

    if ($form['title'] === '') {
        $errors[] = 'Pealkiri on kohustuslik.';
    }
    if (!filter_var($form['release_date'], FILTER_VALIDATE_INT)
        || $form['release_date'] < 1901 || $form['release_date'] > 2155) {
        $errors[] = 'Ilmumisaasta peab olema vahemikus 1901–2155.';
    }
    if (!is_numeric($form['price']) || $form['price'] < 0 || $form['price'] > 999999999.99) {
        $errors[] = 'Sisesta korrektne hind.';
    }
    if (!filter_var($form['pages'], FILTER_VALIDATE_INT) || $form['pages'] < 1) {
        $errors[] = 'Lehekülgede arv peab olema positiivne täisarv.';
    }
    if (!in_array($form['type'], ['new', 'used', 'ebook'], true)) {
        $errors[] = 'Vali korrektne väljaande tüüp.';
    }

    if (!$errors) {
        $save = $pdo->prepare(
            'UPDATE books SET title = ?, release_date = ?, cover_path = ?, language = ?,
             summary = ?, price = ?, stock_saldo = ?, pages = ?, type = ? WHERE id = ?'
        );
        $save->execute([
            $form['title'], $form['release_date'], $form['cover_path'], $form['language'],
            $form['summary'], number_format((float) $form['price'], 2, '.', ''),
            $form['stock_saldo'], $form['pages'], $form['type'], $id,
        ]);
        header("Location: book.php?id=$id&updated=1");
        exit;
    }
}

$inputClass = 'w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-indigo-500';
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Muuda raamatut – <?= e($book['title']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
    <main class="mx-auto max-w-3xl px-6 py-10">
        <a class="text-indigo-700" href="book.php?id=<?= (int) $id ?>">← Tagasi raamatu juurde</a>
        <section class="mt-6 rounded-2xl bg-white p-6 shadow-lg sm:p-9">
            <h1 class="text-3xl font-bold">Muuda raamatut</h1>

            <?php if ($errors) { ?>
                <ul class="mt-5 list-inside list-disc rounded bg-rose-50 p-4 text-rose-800" role="alert">
                    <?php foreach ($errors as $error) { ?><li><?= e($error) ?></li><?php } ?>
                </ul>
            <?php } ?>

            <form class="mt-7 space-y-4" method="post">
                <label class="block">Pealkiri
                    <input class="<?= $inputClass ?>" name="title" maxlength="255" required value="<?= e($form['title']) ?>">
                </label>
                <label class="block">Ilmumisaasta
                    <input class="<?= $inputClass ?>" name="release_date" type="number" min="1901" max="2155" required value="<?= e((string) $form['release_date']) ?>">
                </label>
                <label class="block">Pildi aadress
                    <input class="<?= $inputClass ?>" name="cover_path" value="<?= e($form['cover_path'] ?? '') ?>">
                </label>
                <label class="block">Keel
                    <input class="<?= $inputClass ?>" name="language" maxlength="45" required value="<?= e($form['language']) ?>">
                </label>
                <label class="block">Kirjeldus
                    <textarea class="<?= $inputClass ?>" name="summary" rows="4"><?= e($form['summary'] ?? '') ?></textarea>
                </label>
                <label class="block">Hind (€)
                    <input class="<?= $inputClass ?>" name="price" type="number" min="0" step="0.01" required value="<?= e(number_format((float) $form['price'], 2, '.', '')) ?>">
                </label>
                <label class="block">Laoseis
                    <input class="<?= $inputClass ?>" name="stock_saldo" maxlength="45" required value="<?= e($form['stock_saldo']) ?>">
                </label>
                <label class="block">Lehekülgi
                    <input class="<?= $inputClass ?>" name="pages" type="number" min="1" required value="<?= e((string) $form['pages']) ?>">
                </label>
                <label class="block">Väljaande tüüp
                    <select class="<?= $inputClass ?> bg-white" name="type">
                        <option value="new" <?= $form['type'] === 'new' ? 'selected' : '' ?>>Uus</option>
                        <option value="used" <?= $form['type'] === 'used' ? 'selected' : '' ?>>Kasutatud</option>
                        <option value="ebook" <?= $form['type'] === 'ebook' ? 'selected' : '' ?>>E-raamat</option>
                    </select>
                </label>
                <button class="rounded-lg bg-indigo-600 px-5 py-2.5 font-semibold text-white" type="submit">Salvesta</button>
                <a class="ml-2 text-slate-600" href="book.php?id=<?= (int) $id ?>">Tühista</a>
            </form>
        </section>
    </main>
</body>
</html>
