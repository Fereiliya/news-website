<style>
    :root {
        --primary-bg: #121212;
        --secondary-bg: #1e1e1e;
        --text-primary: #ffffff;
        --text-secondary: #b0b0b0;
        --border-color: #333333;
        --hover-color: #444444;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        background-color: var(--primary-bg);
        color: var(--text-primary);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        line-height: 1.6;
    }

    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 5px;
    }

    .news-container {
        background-color: var(--secondary-bg);
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        padding: 20px;
    }

    .news-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--border-color);
    }

    .news-header h2 {
        font-size: 1.2rem;
        margin: 0;
    }

    .search-bar {
        width: 100%;
        max-width: 200px;
        padding: 8px;
        background-color: var(--primary-bg);
        border: 1px solid var(--border-color);
        color: var(--text-primary);
        border-radius: 4px;
    }

    .news-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid var(--border-color);
    }

    .news-item-content {
        flex-grow: 1;
        margin-right: 15px;
        overflow: hidden;
    }

    .news-title {
        font-size: 1rem;
        margin-bottom: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .news-meta {
        font-size: 0.75rem;
        color: var(--text-secondary);
        margin-bottom: 5px;
    }

    .news-excerpt {
        font-size: 0.85rem;
        color: var(--text-secondary);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .news-actions {
        display: flex;
        flex-shrink: 0;
    }

    .btn {
        background-color: transparent;
        border: 1px solid var(--border-color);
        color: var(--text-primary);
        padding: 5px 10px;
        margin-left: 5px;
        border-radius: 4px;
        font-size: 0.75rem;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: var(--hover-color);
    }

    .btn-delete {
        color: #ff4d4d;
        border-color: #ff4d4d;
    }

    .btn-delete:hover {
        background-color: #ff4d4d;
        color: var(--text-primary);
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 15px;
    }

    .pagination-btn {
        background-color: var(--secondary-bg);
        border: 1px solid var(--border-color);
        color: var(--text-primary);
        padding: 5px 10px;
        margin: 0 5px;
        text-decoration: none;
        border-radius: 4px;
        font-size: 0.85rem;
    }

    .pagination-btn:hover {
        background-color: var(--hover-color);
    }

    @media (max-width: 1200px) {
        .container {
            width: 75%;
            padding: 10px;
        }

        .news-header {
            flex-direction: column;
            align-items: stretch;
            width: 100%;
        }

        .search-bar {
            max-width: 100%;
            margin-top: 10px;
        }

        .news-item {
            flex-direction: column;
            align-items: stretch;
        }

        .news-actions {
            margin-top: 10px;
            justify-content: space-between;
        }
    }

    @media (max-width: 992px) {
        .news-item-content {
            margin-right: 0;
        }
    }

    @media (max-width: 768px) {
        .news-item {
            padding: 10px 0;
        }

        .news-actions {
            margin-top: 5px;
        }
    }

    @media (max-width: 576px) {
        .news-item {
            padding: 5px 0;
        }

        .news-actions {
            margin-top: 0;
        }
    }

    @media (max-width: 480px) {
        .container {
            padding: 5px;
        }

        .news-header {
            padding-bottom: 5px;
        }

        .search-bar {
            padding: 5px;
        }

        .news-item {
            padding: 5px 0;
        }

        .news-actions {
            margin-top: 0;
        }
    }
</style>
</head>

<body>
    <div class="py-4">
        <div class="d-flex justify-content-end">
            <a href="create.php"><button type="button" class="btn btn-dark fs-4 rounded-4 px-5 py-2">Create some news</button></a>
        </div>
    </div>

    <div class="container">
        <div class="news-container">
            <div class="news-header">
                <div class="d-flex flex-row justify-content-between w-100">
                    <div>
                        <h2 class="mb-0 fw-bold fs-2">News Management</h2>
                    </div>
                    <div>
                        <input type="text" class="form-control search-bar w-100" placeholder="Search news...">
                    </div>
                </div>
            </div>

            <div class="news-list">
                <?php foreach ($newsArray as $news): ?>
                    <div class="news-item">
                        <div class="news-item-content">
                            <h5 class="news-title"><?= htmlspecialchars($news['title']) ?></h5>
                            <div class="news-meta">
                                <span>By <?= htmlspecialchars($news['author']) ?></span>
                                <span class="mx-2">|</span>
                                <span><?= date('F d, Y', $news['created_at']->toDateTime()->getTimestamp()) ?></span>
                            </div>
                            <p class="text-truncate"><?= htmlspecialchars($news['content']) ?></p>
                        </div>
                        <div class="news-actions ms-3">
                            <div class="btn-group">
                                <a href="edit.php?id=<?= $news['_id'] ?>" class="btn btn-sm btn-action">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="?delete=<?= $news['_id'] ?>" class="btn btn-sm btn-action btn-delete"
                                    onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <nav aria-label="News navigation">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>