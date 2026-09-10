<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <style>
        :root {
            --bg-color: #f4f6f9;
            --card-bg: #ffffff;
            --primary: #8a70d6;
            --primary-hover: #755bbd;
            --danger: #e27c7c;
            --danger-hover: #c96262;
            --text-dark: #2d3748;
            --text-muted: #718096;
            --border-color: #e2e8f0;
            --mint-bg: #d8f3dc;
            --mint-text: #2d6a4f;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-dark);
            padding: 40px 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        h4 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .nav-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .btn-secondary {
            background-color: #e2e8f0;
            color: var(--text-dark);
        }

        .btn-secondary:hover {
            background-color: #cbd5e1;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            min-width: 280px;
            padding: 14px 18px;
            color: var(--mint-text);
            background: var(--mint-bg);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid #b7e4c7;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification button {
            background: transparent;
            border: 0;
            cursor: pointer;
            font-size: 20px;
            color: var(--mint-text);
            line-height: 1;
            margin-left: 12px;
        }

        .table-card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            background-color: #f8fafc;
            padding: 14px 18px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-color);
        }

        td {
            padding: 16px 18px;
            font-size: 0.95rem;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-dark);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover {
            background-color: #fafbfc;
        }

        .action-links {
            display: flex;
            gap: 10px;
        }

        .link-edit {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .link-edit:hover {
            text-decoration: underline;
        }

        .link-delete {
            color: var(--danger);
            text-decoration: none;
            font-weight: 500;
        }

        .link-delete:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!empty($notification)): ?>
            <div class="notification" role="status" id="notification">
                <span><?= htmlspecialchars($notification, ENT_QUOTES, 'UTF-8'); ?></span>
                <button type="button" onclick="document.getElementById('notification').remove();" aria-label="Close notification">&times;</button>
            </div>
        <?php endif; ?>

        <div class="header-bar">
            <h4>Welcome, <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></h4>
            <div class="nav-actions">
                <?php if ($user_role === 'admin'): ?>
                    <a href="<?= site_url('/product/create'); ?>" class="btn btn-primary">+ Add Product</a>
                <?php endif; ?>
                <a href="<?= site_url('/logout'); ?>" class="btn btn-secondary">Logout</a>
            </div>
        </div>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Created At</th>
                        <?php if ($user_role === 'admin'): ?>
                            <th>Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?></strong></td>
                            <td><?php echo htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>$<?php echo number_format($product['price'], 2); ?></td>
                            <td><?php echo $product['created_at']; ?></td>
                            <?php if ($user_role === 'admin'): ?>
                                <td>
                                    <div class="action-links">
                                        <a href="<?= site_url('/product/edit/' . $product['id']); ?>" class="link-edit">Edit</a>
                                        <a href="<?= site_url('/product/delete/' . $product['id']); ?>" class="link-delete" onclick="return confirm('Delete this product?');">Delete</a>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if (!empty($notification)): ?>
        <script>
            window.setTimeout(function () {
                var notification = document.getElementById('notification');
                if (notification) {
                    notification.remove();
                }
            }, 4000);
        </script>
    <?php endif; ?>
</body>
</html>