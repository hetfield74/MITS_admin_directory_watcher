<?php
/**
 * --------------------------------------------------------------
 * File: mits_admin_directory_watcher.php
 * Date: 17.12.2025
 * Time: 16:18
 *
 * Author: Hetfield
 * Copyright: (c) 2025 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 * --------------------------------------------------------------
 */

if (defined('DIR_ADMIN') && DIR_ADMIN !== 'admin') {
    $realAdminFolderName = trim(DIR_ADMIN, '/');
    $realAdminDir = DIR_FS_DOCUMENT_ROOT . $realAdminFolderName;
    $fallbackDir = DIR_FS_DOCUMENT_ROOT . 'admin';

    $hasWrongDir = is_dir($fallbackDir) && $realAdminDir !== $fallbackDir;

    if (!function_exists('mits_moveRecursive')) {
        function mits_moveRecursive($src, $dst): void
        {
            if (!is_dir($src)) {
                return;
            }

            @mkdir($dst, 0777, true);

            $dir = opendir($src);
            if (!$dir) {
                return;
            }

            while (false !== ($file = readdir($dir))) {
                if ($file === '.' || $file === '..') {
                    continue;
                }

                $srcPath = $src . '/' . $file;
                $dstPath = $dst . '/' . $file;

                if (is_dir($srcPath)) {
                    mits_moveRecursive($srcPath, $dstPath);
                    @rmdir($srcPath);
                } else {
                    if (!@rename($srcPath, $dstPath)) {
                        @copy($srcPath, $dstPath);
                        @unlink($srcPath);
                    }
                }
            }
            closedir($dir);
        }
    }

    $showSuccess = false;
    $showWarning = false;

    if ($hasWrongDir && isset($_POST['move_files'])) {
        mits_moveRecursive($fallbackDir, $realAdminDir);
        @rmdir($fallbackDir);
        $showSuccess = true;
    } elseif ($hasWrongDir) {
        $showWarning = true;
    }

    if ($showSuccess): ?>
      <div id="adminWarningModalOverlay">
        <div class="modal">
          <div class="modal-header">
            ⚠️ <strong>Admin-Ordner Hinweis</strong> <small><span style="white-space:nowrap;">&copy; by <a href="https://www.merz-it-service.de" target="_blank"><span style="padding:2px 4px;border-radius:3px; background:#ffe;color:#6a9;font-weight:bold;">Hetfield (MerZ IT-SerVice)</span></a></span></small>
            <span class="modal-close" onclick="closeModal()">×</span>
          </div>

          <div class="modal-body">
            <svg class="btn-icon" viewBox="0 0 24 24">
              <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm-2 14-4-4 1.4-1.4L10 13.2l6.6-6.6L18 8z" />
            </svg>
            Die Dateien wurden erfolgreich in den richtigen Admin-Ordner verschoben:
            <br><br>
            <span class="folder-badge folder-good">
              <svg viewBox="0 0 20 20" fill="currentColor">
                <path d="M2 6a2 2 0 012-2h4l2 2h6a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
              </svg>
                <?php echo htmlspecialchars($realAdminFolderName); ?>/
            </span>
          </div>

          <div class="modal-footer">
            <button type="button" onclick="window.location.href = window.location.href;">
              <svg class="btn-icon" viewBox="0 0 24 24">
                <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm-2 14-4-4 1.4-1.4L10 13.2l6.6-6.6L18 8z" />
              </svg>
              OK
            </button>
          </div>
        </div>
      </div>
    <?php
    endif; ?>

    <?php
    if ($showWarning): ?>
      <div id="adminWarningModalOverlay">
        <div class="modal">
          <div class="modal-header">
            ⚠️ <strong>Admin-Ordner Hinweis</strong> <small><span style="white-space:nowrap;">&copy; by <a href="https://www.merz-it-service.de" target="_blank"><span style="padding:2px 4px;border-radius:3px; background:#ffe;color:#6a9;font-weight:bold;">Hetfield (MerZ IT-SerVice)</span></a></span></small>
            <span class="modal-close" onclick="closeModal()">×</span>
          </div>

          <div class="modal-body">
            <p>
              Es wurde ein zusätzlicher Ordner
              <span class="folder-badge folder-bad">
                  <svg class="folder-icon" viewBox="0 0 24 24">
                      <path d="M10 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-8l-2-2z" />
                  </svg>
                  admin/
              </span>
              im Shop-Verzeichnis gefunden, obwohl der konfigurierte Admin-Ordner
              <span class="folder-badge folder-good">
                  <svg class="folder-icon" viewBox="0 0 24 24">
                      <path d="M10 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-8l-2-2z" />
                  </svg>
                  <?php
                  echo htmlspecialchars($realAdminFolderName); ?>/
              </span>
              lautet.
            </p>
            <p>
              Das kann z.&nbsp;B. durch Modul- oder Update-Installationen passieren,
              bei denen Dateien in den Standard-Ordner
              <span class="folder-badge folder-norm">
                  <svg class="folder-icon" viewBox="0 0 24 24">
                      <path d="M10 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-8l-2-2z" />
                  </svg>
                  admin/
              </span>
              kopiert wurden.
            </p>
            <div class="admin-hint-box">
              <strong>Hinweis:</strong><br>
              Die Funktion <em>„Dateien verschieben“</em> verschiebt alle im Ordner
              <code>admin/</code> vorhandenen Dateien und Unterordner automatisch
              in den konfigurierten Admin-Ordner.
              <br><br>
              Dabei wird versucht, bestehende Dateien zu überschreiben.
              Je nach Server-Konfiguration, Dateirechten oder individuellen Anpassungen
              <strong>kann dies unerwartete Auswirkungen haben</strong>.
              <br><br>
              Die Nutzung erfolgt <strong>auf eigene Gefahr</strong>.
              Eine <strong>manuelle Prüfung und Übernahme der Dateien</strong>
              ist grundsätzlich vorzuziehen.
            </div>
          </div>

          <div class="modal-footer">
            <form method="post" style="margin:0;">
              <input type="hidden" name="move_files" value="1">
              <button id="adminMoveFilesBtn" type="submit">
                <svg class="btn-icon" viewBox="0 0 24 24">
                  <path d="M14 2H6a2 2 0 0 0-2 2v12l4-4h6a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm3 8v10H5v2h12a2 2 0 0 0 2-2V10h-2z" />
                </svg>
                Dateien verschieben
              </button>
            </form>
            <button id="adminWarningOk" type="button" onclick="closeAdminWarning()">
              <svg class="btn-icon" viewBox="0 0 24 24">
                <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm-2 14-4-4 1.4-1.4L10 13.2l6.6-6.6L18 8z" />
              </svg>
              Alles klar
            </button>
          </div>
        </div>
      </div>
    <?php
    endif; ?>

  <script>
    document.getElementById('adminWarningModalOverlay').style.display = 'block';

    function closeAdminWarning() {
      var overlay = document.getElementById('adminWarningModalOverlay');
      if (overlay) {
        overlay.style.display = 'none';
      }
    }
  </script>

  <style>
    :root {
      --primary: #66aa99;
      --primary-soft: #88bbaa;
      --bg-soft: #ffffee;
      --text: #22313f;
      --danger: #b74444;
      --bg: #ffffee;
      --yellow: #F8D775;
      --yellow-bg: #FFF6D6;
    }

    #adminWarningModalOverlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.45);
      display: none;
      z-index: 99999;
    }

    .modal {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: min(480px, 90vw);
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 12px 35px rgba(0, 0, 0, 0.25);
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Tahoma, sans-serif;
      color: var(--text);
      overflow: hidden;
      animation: adminModalFadeIn 0.25s ease-out;
    }

    .modal-header {
      background: linear-gradient(135deg, var(--primary), var(--primary-soft));
      padding: 14px 20px;
      color: #fff;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .modal-header.success {
      background: linear-gradient(135deg, #6fbfa5, #6a9);
    }

    .modal-close {
      margin-left: auto;
      font-size: 18px;
      color: rgba(255, 255, 255, 0.9);
      cursor: pointer;
      user-select: none;
    }

    .modal-close:hover {
      color: #fff;
    }

    .modal-body {
      padding: 20px 22px 18px;
      background: var(--bg-soft);
    }

    .modal-body p {
      margin: 0 0 10px;
      font-size: 15px;
      line-height: 1.5;
    }

    .modal-footer {
      padding: 0 22px 18px;
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      background: var(--bg-soft);
    }

    .modal-footer button {
      padding: 9px 22px;
      border-radius: 7px;
      border: none;
      cursor: pointer;
      font-size: 14px;
      font-weight: 500;
      transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.2s ease;
    }

    .modal-footer button#adminWarningOk {
      background: var(--primary);
      color: #fff;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    }

    .modal-footer button#adminWarningOk:hover {
      background: var(--primary-soft);
      transform: translateY(-1px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    #adminMoveFilesBtn {
      padding: 9px 22px;
      border-radius: 7px;
      border: none;
      cursor: pointer;
      background: var(--danger);
      color: #fff;
      font-size: 14px;
      font-weight: 500;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
      transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.2s ease;
    }

    #adminMoveFilesBtn:hover {
      background: #dd5555;
      transform: translateY(-1px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    @keyframes adminModalFadeIn {
      from {
        opacity: 0;
        transform: translate(-50%, -60%);
      }
      to {
        opacity: 1;
        transform: translate(-50%, -50%);
      }
    }

    .folder-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 6px 12px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 14px;
      margin: 6px 0;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.12);
    }

    .folder-bad {
      background: #fdecec;
      color: #8f2e2e;
    }

    .folder-good {
      background: #e6f3ef;
      color: #2f6f61;
    }

    .folder-norm {
      background: #eee;
      color: #333;
    }

    .folder-icon {
      width: 20px;
      height: 20px;
      flex-shrink: 0;
    }

    .folder-good .folder-icon {
      fill: #6a9;
    }

    .folder-bad .folder-icon {
      fill: #b74444;
    }

    .folder-norm .folder-icon {
      fill: #F8D775;
    }

    .btn-icon {
      width: 18px;
      height: 18px;
      fill: currentColor;
      margin-right: 6px;
      vertical-align: middle;
    }

    .admin-hint-box {
      margin-top: 14px;
      padding: 12px 14px;
      border-left: 4px solid #F8D775;
      background: #FFFBEA;
      color: #5c4a00;
      font-size: 13px;
      line-height: 1.45;
      border-radius: 6px;
    }

    .admin-hint-box code {
      background: rgba(0,0,0,0.05);
      padding: 1px 4px;
      border-radius: 3px;
      font-size: 12px;
    }

  </style>

    <?php
}
