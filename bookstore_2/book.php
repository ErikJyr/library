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

$authorsQuery = $pdo->prepare(
    'SELECT CONCAT(authors.first_name, " ", authors.last_name)
     FROM authors
     JOIN book_authors ON authors.id = book_authors.author_id
     WHERE book_authors.book_id = ?'
);
$authorsQuery->execute([$id]);
$book['authors'] = implode(', ', $authorsQuery->fetchAll(PDO::FETCH_COLUMN));
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($book['title']) ?> – raamatu andmed</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
    <main class="mx-auto max-w-5xl px-6 py-10">
        <a class="text-indigo-700" href="index.php">← Raamatute nimekiri</a>
        <article class="mt-6 grid overflow-hidden rounded-2xl bg-white shadow-lg md:grid-cols-[280px_1fr]">
            <div class="flex items-center justify-center bg-slate-200 p-6">
                <?php if ($book['cover_path']) { ?>
                    <img class="max-h-96 w-full object-contain" src="<?= e($book['cover_path']) ?>" alt="<?= e($book['title']) ?>">
                <?php } else { ?>
                    <p>Raamatu pilt puudub.</p>
                <?php } ?>
            </div>
            <div class="p-6 sm:p-9">
                <p class="font-semibold uppercase tracking-widest text-indigo-600">Raamatu andmed</p>
                <h1 class="mt-2 text-3xl font-bold"><?= e($book['title']) ?></h1>

                <?php if (isset($_GET['updated'])) { ?>
                    <p class="mt-4 rounded bg-emerald-50 p-3 text-emerald-800" role="status">Muudatused salvestati.</p>
                <?php } ?>

                <dl class="mt-8 grid gap-5 sm:grid-cols-2">
                    <div><dt class="text-slate-500">Autor(id)</dt><dd><?= e($book['authors'] ?? 'Autor teadmata') ?></dd></div>
                    <div><dt class="text-slate-500">Ilmumisaasta</dt><dd><?= e((string) $book['release_date']) ?></dd></div>
                    <div><dt class="text-slate-500">Keel</dt><dd><?= e($book['language']) ?></dd></div>
                    <div><dt class="text-slate-500">Hind</dt><dd class="font-bold text-indigo-700"><?= number_format((float) $book['price'], 2, ',', ' ') ?> €</dd></div>
                    <div><dt class="text-slate-500">Laoseis</dt><dd><?= e($book['stock_saldo']) ?></dd></div>
                    <div><dt class="text-slate-500">Lehekülgi</dt><dd><?= (int) $book['pages'] ?></dd></div>
                    <div><dt class="text-slate-500">Väljaande tüüp</dt><dd><?= e($book['type']) ?></dd></div>
                    <div class="sm:col-span-2"><dt class="text-slate-500">Kirjeldus</dt><dd><?= e($book['summary'] ?? 'Kirjeldus puudub') ?></dd></div>
                </dl>

                <nav class="mt-8 flex gap-3 border-t pt-6" aria-label="Raamatu tegevused">
                    <a class="rounded bg-indigo-600 px-4 py-2 text-white" href="edit.php?id=<?= (int) $id ?>">Muuda</a>
                    <a class="rounded border border-rose-300 px-4 py-2 text-rose-700" href="delete.php?id=<?= (int) $id ?>">Kustuta</a>
                </nav>
            </div>
        </article>
    </main>
</body>
</html>
