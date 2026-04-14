@echo off
REM ================================================================================
REM STOCKFLOW INVENTORY SYSTEM - AUTOMATED WINDOWS SETUP
REM Run this file to automatically setup the entire project
REM ================================================================================

setlocal enabledelayedexpansion

echo.
echo ================================================================================
echo STOCKFLOW INVENTORY SYSTEM - Windows Automated Setup
echo ================================================================================
echo.

REM Check if PHP is installed
echo [1/10] Checking PHP installation...
php --version >nul 2>&1
if errorlevel 1 (
    echo ERROR: PHP is not installed or not in PATH
    echo Download from: https://windows.php.net/download/
    echo After installing, add PHP to your Windows PATH
    pause
    exit /b 1
)
echo ✓ PHP found
echo.

REM Check if Composer is installed
echo [2/10] Checking Composer installation...
composer --version >nul 2>&1
if errorlevel 1 (
    echo ERROR: Composer is not installed or not in PATH
    echo Download from: https://getcomposer.org/download/
    pause
    exit /b 1
)
echo ✓ Composer found
echo.

REM Check if Node.js is installed
echo [3/10] Checking Node.js installation...
node --version >nul 2>&1
if errorlevel 1 (
    echo ERROR: Node.js is not installed
    echo Download from: https://nodejs.org/ ^(v18 or higher^)
    pause
    exit /b 1
)
echo ✓ Node.js found
echo.

REM Check if MySQL is installed
echo [4/10] Checking MySQL installation...
mysql --version >nul 2>&1
if errorlevel 1 (
    echo WARNING: MySQL is not installed or not in PATH
    echo Download from: https://dev.mysql.com/downloads/mysql/
    echo After installing MySQL, add it to your PATH
    echo.
    set /p mysql_reminder="Press Enter to continue anyway (make sure MySQL is running)..."
) else (
    echo ✓ MySQL found
)
echo.

REM Check if we're in the right directory
echo [4/10] Verifying project structure...
if not exist "composer.json" (
    echo ERROR: composer.json not found
    echo Make sure you're in the DC5_InertiaFinals project directory
    pause
    exit /b 1
)
if not exist ".env.example" (
    echo ERROR: .env.example not found
    echo Project structure is incomplete
    pause
    exit /b 1
)
echo ✓ Project structure verified
echo.

REM Install PHP dependencies
echo [5/10] Installing PHP dependencies with Composer...
call composer install
if errorlevel 1 (
    echo ERROR: Composer install failed
    pause
    exit /b 1
)
echo ✓ PHP dependencies installed
echo.

REM Install Node dependencies
echo [6/10] Installing Node.js dependencies...
call npm install
if errorlevel 1 (
    echo ERROR: npm install failed
    pause
    exit /b 1
)
echo ✓ Node dependencies installed
echo.

REM Setup environment file
echo [7/10] Setting up environment configuration...
if exist ".env" (
    echo .env already exists, skipping...
) else (
    copy .env.example .env >nul
    echo ✓ .env file created
    echo.
    echo IMPORTANT: Edit .env and set your MySQL credentials:
    echo   DB_HOST=127.0.0.1
    echo   DB_PORT=3306
    echo   DB_DATABASE=stockflow
    echo   DB_USERNAME=root
    echo   DB_PASSWORD=your_mysql_password
    echo.
    set /p env_edited="After editing .env, press Enter to continue..."
)
echo.

REM Generate app key
echo [8/10] Generating application key...
php artisan key:generate --force
if errorlevel 1 (
    echo ERROR: Key generation failed
    pause
    exit /b 1
)
echo ✓ Application key generated
echo.

REM Create MySQL database
echo [9/10] Creating MySQL database...
echo Please ensure MySQL is running and enter your credentials when prompted.
echo.
mysql -u root -e "CREATE DATABASE IF NOT EXISTS stockflow;" 2>nul
if errorlevel 1 (
    echo WARNING: Could not automatically create database
    echo.
    echo Create the database manually by running in MySQL:
    echo   CREATE DATABASE stockflow;
    echo.
    set /p db_created="After creating the database, press Enter to continue..."
) else (
    echo ✓ MySQL database created
)
echo.

REM Run migrations and seed
echo [10/10] Setting up database tables and demo data...
php artisan migrate:fresh --seed --force
if errorlevel 1 (
    echo ERROR: Database migration failed
    pause
    exit /b 1
)
echo ✓ Database setup complete
echo.

REM Completion message
echo ================================================================================
echo SETUP COMPLETE!
echo ================================================================================
echo.
echo Next steps:
echo.
echo 1. Open TWO terminal windows
echo.
echo TERMINAL 1 - Compile frontend assets (keep running):
echo    npm run dev
echo.
echo TERMINAL 2 - Start Laravel server:
echo    php artisan serve
echo.
echo Then open your browser to: http://localhost:8000
echo.
echo.
echo DEMO CREDENTIALS:
echo ============================================
echo Admin Email:    admin@example.com
echo Admin Password: password
echo.
echo Employee Email:    employee1@example.com
echo Employee Password: password
echo (employee2-5@example.com also available)
echo.
echo ============================================
echo.
pause
