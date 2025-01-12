<!-- Pagination -->
<nav aria-label="Task pagination">
    <ul class="pagination justify-content-center">
        <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                    Previous
                </a>
            </li>
        <?php endif; ?>

        <?php if ($totalPages > 1): ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                        Next
                    </a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
</nav>