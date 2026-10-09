<?php
require 'db.php';
$books = $pdo->query('SELECT id, title FROM books ORDER BY title');
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Raamatud</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
    <main class="mx-auto max-w-4xl px-6 py-12">
        <header class="mb-8">
            <p class="font-semibold uppercase tracking-widest text-indigo-600">Raamatukogu</p>
            <h1 class="mt-2 text-4xl font-bold">Raamatud</h1>
            <p class="mt-2 text-slate-600">Vali raamat, et vaadata selle andmeid.</p>
        </header>
        <ul class="grid gap-3 sm:grid-cols-2">
            <?php while ($book = $books->fetch()) { ?>
                <li>
                    <a class="flex justify-between rounded-xl border bg-white p-5 shadow-sm hover:border-indigo-300 hover:shadow-md"
                       href="book.php?id=<?= (int) $book['id'] ?>">
                        <span class="font-semibold"><?= e($book['title']) ?></span>
                        <span class="text-indigo-600" aria-hidden="true">→</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </main>
</body>
</html>
