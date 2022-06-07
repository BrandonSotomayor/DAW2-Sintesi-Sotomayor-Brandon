import { Injectable } from '@angular/core';
import { WebPlugin } from '@capacitor/core';
import { BarcodeScanner, CameraDirection, CheckPermissionOptions, ScanOptions, SupportedFormat, ScanResult, StopScanOptions, TorchStateResult } from '@capacitor-community/barcode-scanner';

@Injectable({
  providedIn: 'root'
})
export class BarcodescannerService {

  private _allowed: boolean;// = false;

  constructor() {
    this._allowed = false;
  }

  async configureScanner(): Promise<void> {
    const options: ScanOptions = {
        targetedFormats: [SupportedFormat.EAN_13, SupportedFormat.QR_CODE],
        cameraDirection: CameraDirection.BACK
    }
    const status = BarcodeScanner.prepare(options);
    return status;
  }
  
  async checkPermissions(): Promise<boolean>{
    const options: CheckPermissionOptions = {
      force: true
    };
    const status = await BarcodeScanner.checkPermission(options);
    if ( status.granted ) {
      this._allowed= true;
      return true;
    }
    else {
      BarcodeScanner.openAppSettings();
      this._allowed = false;
      return false;
    }
  }

  async startScanner(): Promise<string>{
    if ( this._allowed ){
      BarcodeScanner.hideBackground();
      const result = await BarcodeScanner.startScan();
      if ( result.hasContent ) return result.content;
    }
    return null;
  }

  stopScanner(): void {
    BarcodeScanner.stopScan();
  }
  
}
