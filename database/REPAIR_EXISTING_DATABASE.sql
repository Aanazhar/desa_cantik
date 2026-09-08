-- Desa Cantik: repair an existing database that is missing
-- site_sections.requirements.
-- Safe to run repeatedly.

SET @db := DATABASE();

SET @sql := (
    SELECT IF(
        EXISTS(
            SELECT 1
            FROM information_schema.columns
            WHERE table_schema = @db
              AND table_name = 'site_sections'
              AND column_name = 'requirements'
        ),
        'SELECT 1',
        'ALTER TABLE site_sections ADD COLUMN requirements JSON NULL AFTER form_fields'
    )
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Verify after execution:
SHOW COLUMNS FROM site_sections LIKE 'requirements';
