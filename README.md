# Daily Punch Upload System 📊

An enterprise PHP application for uploading employee punch/attendance data from Excel files to an Informix database.

## ⚠️ Security Notice

**This application contains database credentials in `conn.php`.** 

Before deploying:
1. Never commit `conn.php` to public repositories
2. Use environment variables for credentials in production
3. Restrict database user permissions to minimum required

## 🔧 Features

- Excel file upload (.xls format)
- Data validation before insert
- Duplicate record detection
- Batch insert with transaction support
- Visual feedback with data preview table

## 📁 Project Structure

```
daily_punch_upload/
├── aweil_ofpkr_upl.php    # Main upload interface
├── conn.php               # Database connections (⚠️ contains credentials)
├── lib_func.php           # Helper functions
├── img/                   # Uploaded files directory
├── 01022024/              # Sample data folder
└── PHPExcel-1.8/          # Excel library (legacy)
```

## 🚀 Installation

### Requirements
- PHP 7.0+ with PDO extension
- Informix database driver
- Web server (Apache/Nginx)

### Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/RajmaniShukla/daily_punch_upload.git
   ```

2. **Configure database connection:**
   Edit `conn.php` with your credentials:
   ```php
   $dbh = new PDO("informix:; database=YOUR_DB; ...", "user", "pass");
   ```

3. **Create upload directory:**
   ```bash
   mkdir -p img
   chmod 755 img
   ```

4. **Set permissions:**
   ```bash
   chmod 644 *.php
   ```

## 📤 Usage

1. Access `aweil_ofpkr_upl.php` in browser
2. Select an Excel file (.xls format)
3. File format: `PL-{dd-mm-yyyy}.xls`
4. Click "Upload Excel File"
5. Review the data preview
6. Data is automatically inserted into `t_punch_det` table

## 📋 Excel File Format

The Excel file should have the following columns:

| Column | Description |
|--------|-------------|
| 0 | Index |
| 1 | CardNo (Employee ID) |
| 2 | Name |
| 3 | Date (Punch Date) |
| 4 | Time (HH:MM) |
| 5 | Status |
| 6 | Reader Address |

## 🗃️ Database Schema

```sql
CREATE TABLE t_punch_det (
    per_no VARCHAR(20),
    punchdate DATE,
    hh INTEGER,
    mm INTEGER,
    readeraddress VARCHAR(50)
);
```

## 🔄 Future Improvements

- [ ] Migrate from PHPExcel to PhpSpreadsheet
- [ ] Add prepared statements for SQL injection prevention
- [ ] Implement proper session authentication
- [ ] Add XLSX support
- [ ] Create configuration file for settings
- [ ] Add logging system

## 📄 License

Proprietary - Internal Use Only

---

Maintained by [Rajmani Shukla](https://github.com/RajmaniShukla)
