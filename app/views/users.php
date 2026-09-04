<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        :root {
            --ink: #26364a;
            --muted: #6f7d8f;
            --line: #e3eaf1;
            --blue: #dff1f5;
            --green: #e7f4e9;
            --lavender: #eee8fb;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 48px 20px;
            color: var(--ink);
            background: linear-gradient(135deg, #f5fbfc 0%, #f5f3fb 52%, #f4faf4 100%);
            font-family: "Trebuchet MS", "Segoe UI", sans-serif;
        }

        .container {
            width: min(1080px, 100%);
            margin: 0 auto;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(255, 255, 255, 0.9);
            border-radius: 18px;
            box-shadow: 0 20px 50px rgba(67, 86, 112, 0.12);
        }

        .page-header {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 24px;
            padding: 34px 36px 28px;
            background: linear-gradient(110deg, var(--blue), var(--lavender) 58%, var(--green));
        }

        .eyebrow {
            margin: 0 0 8px;
            color: #54758b;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(2rem, 5vw, 3.1rem);
            font-weight: 400;
            letter-spacing: 0;
        }

        .intro {
            max-width: 440px;
            margin: 10px 0 0;
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .count {
            flex: 0 0 auto;
            padding: 12px 16px;
            color: #5b4d83;
            background: rgba(255, 255, 255, 0.68);
            border: 1px solid rgba(255, 255, 255, 0.85);
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .table-wrap {
            overflow-x: auto;
            padding: 24px 28px 30px;
        }

        table {
            width: 100%;
            min-width: 680px;
            border-collapse: collapse;
            font-size: 0.94rem;
        }

        th {
            padding: 14px 16px;
            color: #607287;
            background: #f6f9fb;
            border-bottom: 1px solid var(--line);
            font-size: 0.72rem;
            letter-spacing: 0.1em;
            text-align: left;
            text-transform: uppercase;
        }

        th:first-child {
            border-radius: 10px 0 0 10px;
        }

        th:last-child {
            border-radius: 0 10px 10px 0;
        }

        td {
            padding: 18px 16px;
            border-bottom: 1px solid var(--line);
        }

        tbody tr {
            transition: background-color 160ms ease;
        }

        tbody tr:hover {
            background: #fbfaff;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        td:first-child {
            color: #6b7b8c;
            font-weight: 700;
        }

        td:nth-child(4) {
            color: #4f7480;
        }

        .empty {
            padding: 42px 16px;
            color: var(--muted);
            text-align: center;
        }

        @media (max-width: 640px) {
            body {
                padding: 20px 12px;
            }

            .page-header {
                display: block;
                padding: 28px 22px 24px;
            }

            .count {
                display: inline-block;
                margin-top: 20px;
            }

            .table-wrap {
                padding: 16px 14px 20px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <header class="page-header">
        <div>
            <p class="eyebrow">LavaLust directory</p>
            <h1>Registered Users</h1>
            <p class="intro">A clear view of everyone connected to your application.</p>
        </div>
        <div class="count"><?= count($users ?? []); ?> <?= count($users ?? []) === 1 ? 'member' : 'members'; ?></div>
    </header>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= html_escape($user['id'] ?? ''); ?></td>
                            <td><?= html_escape($user['firstname'] ?? ''); ?></td>
                            <td><?= html_escape($user['lastname'] ?? ''); ?></td>
                            <td><?= html_escape($user['email'] ?? ''); ?></td>
                            <td><?= html_escape($user['username'] ?? ''); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="empty">No users found in the database.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>