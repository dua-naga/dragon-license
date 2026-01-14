<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dragon License')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: hsl(0 0% 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: hsl(0 0% 3.9%);
            padding: 20px;
        }
        .container {
            max-width: 420px;
            width: 100%;
            padding: 2rem;
            background: hsl(0 0% 100%);
            border-radius: 0.5rem;
            border: 1px solid hsl(0 0% 89.8%);
        }
        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        .logo h1 {
            font-size: 1.25rem;
            font-weight: 600;
            color: hsl(0 0% 3.9%);
            letter-spacing: -0.025em;
        }
        .content h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            text-align: center;
            color: hsl(0 0% 3.9%);
            letter-spacing: -0.025em;
        }
        .content > p {
            text-align: center;
            color: hsl(0 0% 45.1%);
            font-size: 0.875rem;
            margin-bottom: 2rem;
            line-height: 1.5;
        }
        .info-box {
            background: hsl(0 0% 98%);
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1.25rem;
            border: 1px solid hsl(0 0% 89.8%);
        }
        .info-box h4 {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: hsl(0 0% 45.1%);
            margin-bottom: 0.75rem;
            font-weight: 500;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.875rem;
            padding: 0.375rem 0;
        }
        .info-row:not(:last-child) {
            border-bottom: 1px solid hsl(0 0% 89.8%);
        }
        .info-row .label {
            color: hsl(0 0% 45.1%);
        }
        .info-row .value {
            color: hsl(0 0% 3.9%);
            font-weight: 500;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            background-color: hsl(0 0% 9%);
            color: hsl(0 0% 98%);
            border: 1px solid hsl(0 0% 9%);
            border-radius: 0.375rem;
            transition: all 0.2s;
            text-decoration: none;
            cursor: pointer;
            text-align: center;
        }
        .btn:hover {
            background-color: hsl(0 0% 3.9%);
            border-color: hsl(0 0% 3.9%);
        }
        .btn:focus-visible {
            outline: 2px solid hsl(0 0% 9%);
            outline-offset: 2px;
        }
        .btn-secondary {
            background-color: transparent;
            border: 1px solid hsl(0 0% 89.8%);
            color: hsl(0 0% 3.9%);
        }
        .btn-secondary:hover {
            background-color: hsl(0 0% 96.1%);
            border-color: hsl(0 0% 89.8%);
        }
        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .btn-group .btn {
            flex: 1;
        }
        .form-group {
            margin-bottom: 16px;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: hsl(0 0% 3.9%);
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 0.625rem 1rem;
            border: 1px solid hsl(0 0% 89.8%);
            border-radius: 0.375rem;
            background: hsl(0 0% 100%);
            color: hsl(0 0% 3.9%);
            font-size: 0.875rem;
            transition: border-color 0.2s;
        }
        .form-group input::placeholder {
            color: hsl(0 0% 45.1%);
        }
        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: hsl(0 0% 9%);
            background: hsl(0 0% 100%);
        }
        .alert {
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
        }
        .alert-danger {
            background: hsl(0 62.8% 30.6% / 0.1);
            border: 1px solid hsl(0 62.8% 30.6% / 0.2);
            color: hsl(0 84.2% 60.2%);
        }
        .alert-success {
            background: hsl(142.1 76.2% 36.3% / 0.1);
            border: 1px solid hsl(142.1 76.2% 36.3% / 0.2);
            color: hsl(142.1 70.6% 45.3%);
        }
        .steps {
            display: flex;
            justify-content: center;
            margin-bottom: 25px;
            gap: 8px;
        }
        .step {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            background: hsl(0 0% 98%);
            border: 1px solid hsl(0 0% 89.8%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            font-size: 0.75rem;
            color: hsl(0 0% 45.1%);
        }
        .step.active {
            background: hsl(0 0% 9%);
            border-color: hsl(0 0% 9%);
            color: hsl(0 0% 98%);
        }
        .step.completed {
            background: hsl(142.1 70.6% 45.3%);
            border-color: hsl(142.1 70.6% 45.3%);
            color: hsl(0 0% 98%);
        }
        .icon-error {
            text-align: center;
            margin-bottom: 20px;
        }
        .icon-error svg {
            width: 60px;
            height: 60px;
        }
        .display-field {
            background: hsl(0 0% 98%);
            padding: 0.625rem 1rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            color: hsl(0 0% 3.9%);
            margin-top: 0.5rem;
            border: 1px solid hsl(0 0% 89.8%);
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="container">
        <div class="logo">
            <h1>Dragon License</h1>
        </div>
        @yield('content')
    </div>
    @yield('scripts')
</body>
</html>
