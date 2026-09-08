#!/bin/bash
# VERIFICATION SCRIPT untuk Fitur Profil Desa Sections
# Jalankan script ini untuk memverifikasi semua file sudah dibuat dengan benar

echo "═══════════════════════════════════════════════════════════════"
echo "🔍 VERIFIKASI FITUR PROFIL DESA SECTIONS"
echo "═══════════════════════════════════════════════════════════════"
echo ""

# Color codes
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Counter
TOTAL=0
PASSED=0

# Function to check file
check_file() {
    TOTAL=$((TOTAL + 1))
    if [ -f "$1" ]; then
        echo -e "${GREEN}✓${NC} $1"
        PASSED=$((PASSED + 1))
    else
        echo -e "${RED}✗${NC} $1 (MISSING)"
    fi
}

# Function to check directory
check_dir() {
    TOTAL=$((TOTAL + 1))
    if [ -d "$1" ]; then
        echo -e "${GREEN}✓${NC} $1 (Directory exists)"
        PASSED=$((PASSED + 1))
    else
        echo -e "${RED}✗${NC} $1 (MISSING)"
    fi
}

echo "📁 CHECKING FILE STRUCTURE..."
echo ""

echo "Database Files:"
check_file "database/migrations/2026_08_16_000001_create_desa_profile_sections_table.php"
check_file "database/seeders/DesaProfileSectionSeeder.php"

echo ""
echo "Model Files:"
check_file "app/Models/DesaProfileSection.php"

echo ""
echo "Controller Files:"
check_file "app/Http/Controllers/Admin/DesaProfileSectionController.php"
check_file "app/Http/Controllers/HomeController.php"

echo ""
echo "View Files:"
check_file "resources/views/profil-desa-tabbed.blade.php"
check_file "resources/views/admin/desa-profile-sections.blade.php"
check_file "resources/views/layouts/admin.blade.php"

echo ""
echo "Configuration Files:"
check_file "routes/web.php"

echo ""
echo "Documentation Files:"
check_file "FITUR_PROFIL_DESA_SECTIONS.md"
check_file "IMPLEMENTASI_SUMMARY.md"
check_file "QUICK_START.txt"

echo ""
echo "Directories:"
check_dir "app/Http/Controllers/Admin"
check_dir "public/uploads"

echo ""
echo "═══════════════════════════════════════════════════════════════"
echo "📊 VERIFICATION RESULT: $PASSED / $TOTAL files exist"
echo "═══════════════════════════════════════════════════════════════"
echo ""

if [ $PASSED -eq $TOTAL ]; then
    echo -e "${GREEN}✓ ALL FILES PRESENT - Ready to run migrations!${NC}"
    echo ""
    echo "Next steps:"
    echo "1. php artisan migrate"
    echo "2. php artisan db:seed --class=DesaProfileSectionSeeder"
    echo "3. php artisan cache:clear"
    echo ""
else
    echo -e "${RED}✗ SOME FILES MISSING${NC}"
    echo "Please check the files marked with ✗ above"
    echo ""
fi

echo "═══════════════════════════════════════════════════════════════"
echo ""
