<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Laundry Guide - Drip & Dry Laundry</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background: #f8f9fa;
            color: #2c3e50;
            min-height: 100vh;
        }
        
        .header {
            background: linear-gradient(135deg, #4A5F80 0%, #3b4a63 100%);
            color: white;
            padding: 20px 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .logo {
            height: 45px;
        }
        
        .nav-controls {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .nav-btn {
            background: rgba(255,255,255,0.2);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .nav-btn:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }
        
        .guide-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 30px;
        }
        
        .guide-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .guide-title {
            font-size: 36px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
        }
        
        .guide-subtitle {
            font-size: 18px;
            color: #7f8c8d;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .guide-sections {
            display: grid;
            gap: 30px;
        }
        
        .guide-section {
            background: white;
            border-radius: 16px;
            padding: 35px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            border: 1px solid #f1f3f4;
        }
        
        .section-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f8f9fa;
        }
        
        .section-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #4A5F80 0%, #3b4a63 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
        }
        
        .section-title {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
        }
        
        .steps-list {
            list-style: none;
        }
        
        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .step-item:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }
        
        .step-number {
            width: 35px;
            height: 35px;
            background: #4A5F80;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }
        
        .step-content {
            flex: 1;
        }
        
        .step-text {
            color: #2c3e50;
            line-height: 1.6;
        }
        
        .tips-box {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            border: 2px solid #ffd43b;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
        }
        
        .tips-title {
            color: #856404;
            font-weight: 700;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .tips-list {
            color: #856404;
            padding-left: 20px;
            line-height: 1.6;
        }
        
        .action-section {
            text-align: center;
            margin-top: 40px;
        }
        
        .book-now-btn {
            background: linear-gradient(135deg, #4A5F80 0%, #3b4a63 100%);
            color: white;
            padding: 16px 32px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .book-now-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(74, 95, 128, 0.3);
        }
        
        @media (max-width: 768px) {
            .guide-container {
                padding: 0 20px;
                margin: 30px auto;
            }
            
            .guide-title {
                font-size: 28px;
            }
            
            .guide-section {
                padding: 25px;
            }
            
            .section-header {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }
            
            .step-item {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }
        }
        
        @media (max-width: 480px) {
            .header {
                padding: 15px 20px;
            }
            
            .guide-title {
                font-size: 24px;
            }
            
            .guide-section {
                padding: 20px;
            }
            
            .section-icon {
                width: 50px;
                height: 50px;
                font-size: 24px;
            }
            
            .section-title {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <img src="logo.png" alt="Drip & Dry Laundry" class="logo">
            <div class="nav-controls">
                <button class="nav-btn" onclick="history.back()">
                    <span class="material-symbols-outlined">arrow_back</span>
                </button>
            </div>
        </div>
    </div>
    
    <div class="guide-container">
        <div class="guide-header">
            <h1 class="guide-title">Laundry Guide</h1>
            <p class="guide-subtitle">Complete instructions for washing and drying your clothes</p>
        </div>
        
        <div class="guide-sections">
            <div class="guide-section">
                <div class="section-header">
                    <div class="section-icon">
                        <span class="material-symbols-outlined">local_laundry_service</span>
                    </div>
                    <h2 class="section-title">Washing Instructions</h2>
                </div>
                
                <ul class="steps-list">
                    <li class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <p class="step-text">Separate your clothes by color (whites, lights, darks) and fabric type</p>
                        </div>
                    </li>
                    <li class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <p class="step-text">Check all pockets and remove any items. Zip up zippers and fasten hooks</p>
                        </div>
                    </li>
                    <li class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <p class="step-text">Place clothes in the washing machine, making sure not to overload it</p>
                        </div>
                    </li>
                    <li class="step-item">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <p class="step-text">Add detergent to the designated compartment. Use the recommended amount</p>
                        </div>
                    </li>
                    <li class="step-item">
                        <div class="step-number">5</div>
                        <div class="step-content">
                            <p class="step-text">Select the appropriate wash cycle based on fabric type and soil level</p>
                        </div>
                    </li>
                    <li class="step-item">
                        <div class="step-number">6</div>
                        <div class="step-content">
                            <p class="step-text">Start the machine and wait for the cycle to complete</p>
                        </div>
                    </li>
                </ul>
                
                <div class="tips-box">
                    <h3 class="tips-title">
                        <span class="material-symbols-outlined">lightbulb</span>
                        Pro Tips
                    </h3>
                    <ul class="tips-list">
                        <li>Use cold water for dark colors to prevent fading</li>
                        <li>Turn delicate items inside out to protect them</li>
                        <li>Don't mix heavy items with light fabrics</li>
                        <li>Use mesh bags for delicate items like lingerie</li>
                    </ul>
                </div>
            </div>
            
            <div class="guide-section">
                <div class="section-header">
                    <div class="section-icon">
                        <span class="material-symbols-outlined">dry</span>
                    </div>
                    <h2 class="section-title">Drying Instructions</h2>
                </div>
                
                <ul class="steps-list">
                    <li class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <p class="step-text">After washing, transfer clothes to the dryer located above the washing machine</p>
                        </div>
                    </li>
                    <li class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <p class="step-text">Close the dryer door securely to ensure proper operation</p>
                        </div>
                    </li>
                    <li class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <p class="step-text">Tap your card on the scanner located on the dryer machine</p>
                        </div>
                    </li>
                    <li class="step-item">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <p class="step-text">Press the power button to start the drying cycle</p>
                        </div>
                    </li>
                    <li class="step-item">
                        <div class="step-number">5</div>
                        <div class="step-content">
                            <p class="step-text">Wait for the indicated time on the display (usually 45-60 minutes)</p>
                        </div>
                    </li>
                    <li class="step-item">
                        <div class="step-number">6</div>
                        <div class="step-content">
                            <p class="step-text">When you hear the "beep" sound, your clothes are ready to be removed</p>
                        </div>
                    </li>
                </ul>
                
                <div class="tips-box">
                    <h3 class="tips-title">
                        <span class="material-symbols-outlined">lightbulb</span>
                        Drying Tips
                    </h3>
                    <ul class="tips-list">
                        <li>Don't overload the dryer - clothes need space to tumble</li>
                        <li>Remove clothes immediately after drying to prevent wrinkles</li>
                        <li>Use lower heat settings for delicate fabrics</li>
                        <li>Clean the lint filter before each use for better efficiency</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="action-section">
            <a href="tanggal.php" class="book-now-btn">Book Laundry Service Now</a>
        </div>
    </div>
</body>
</html>